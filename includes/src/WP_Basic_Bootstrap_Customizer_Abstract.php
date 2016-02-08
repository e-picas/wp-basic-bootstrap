<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Class WP_Basic_Bootstrap_Customizer_Api
 *
 * Implements some helper methods to use the Wordpress Customizer API
 * from an array of entries.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since WP_Basic_Bootstrap 1.0
 */
abstract class WP_Basic_Bootstrap_Customizer_Abstract
{

    /**
     * @var self Singleton instance
     * @since WP_Basic_Bootstrap 1.0
     */
    protected static $_instance = null;

    /**
     * @var \WP_Customize_Manager
     * @since WP_Basic_Bootstrap 1.0
     */
    protected $customizer;

    private $known_ids = array();

    /**
     * WP_Basic_Bootstrap_Customizer constructor
     *
     * @param \WP_Customize_Manager $wp_customizer
     * @since WP_Basic_Bootstrap 1.0
     */
    protected function __construct(\WP_Customize_Manager $wp_customizer)
    {
        $this->customizer = $wp_customizer;
    }

    /**
     * Get the singleton instance
     *
     * @param \WP_Customize_Manager $wp_customizer
     * @since WP_Basic_Bootstrap 1.0
     */
    public static function getInstance(\WP_Customize_Manager $wp_customizer)
    {
        if (is_null(self::$_instance)) {
            $cls = get_called_class();
            self::$_instance = new $cls($wp_customizer);
        }
        return self::$_instance;
    }

    /**
     * Get the default value of a setting
     *
     * @param $val
     * @param string $default
     * @return string
     * @since WP_Basic_Bootstrap 1.0
     */
    abstract public function getDefault($val, $default = '');

    /**
     * Process a full stack of data based on its `object` value in "section", "setting" and "control"
     *
     * @param array $data The data array to process
     * @param bool $parent Is the `$data` array an aggregated one
     */
    public function processData(array $data, $parent = false, $parent_id = null)
    {
        if ($parent) {
            foreach ($data as $name=>$items) {
                $this->processData($items, false, $name);
            }
            return;
        }

        if (isset($data['object'])) {
            switch ($data['object']) {

                case 'panel':
                    // extract and prepare sections
                    $sections = array();
                    if (isset($data['sections'])) {
                        $sections = $data['sections'];
                        unset($data['sections']);
                    }
                    foreach ($sections as $i=>$section) {
                        if (!isset($sections[$i]['priority'])) {
                            $sections[$i]['priority'] = $i;
                        }
                    }
                    // create the section
                    $this->setPanel(
                        $parent_id, $data, $sections
                    );
                    break;

                case 'sections':
                    if (is_null($parent_id) && isset($data['panel'])) {
                        $parent_id = $data['panel'];
                    }
                    $count = 0;
                    foreach ($data as $i=>$item) {
                        if (!is_array($item)) {
                            continue;
                        }
                        if (!isset($item['priority'])) {
                            $item['priority'] = $count;
                        }
                        if (!isset($item['id']) && is_string($i)) {
                            $item['id'] = $i;
                        }
                        $this->setSection(
                            $item['id'],
                            $item,
                            null,
                            $parent_id
                        );
                        $count++;
                    }
                    break;

                case 'section':
                    if (is_null($parent_id) && isset($data['panel'])) {
                        $parent_id = $data['panel'];
                    }
                    // extract and prepare settings
                    $settings = array();
                    if (isset($data['settings'])) {
                        $settings = $data['settings'];
                        unset($data['settings']);
                    }
                    foreach ($settings as $i=>$setting) {
                        if (!isset($settings[$i]['priority'])) {
                            $settings[$i]['priority'] = $i;
                        }
                    }
                    // create the section
                    $this->setSection(
                        $parent_id, $data, $settings
                    );
                    break;

                case 'settings':
                    if (is_null($parent_id) && isset($data['section'])) {
                        $parent_id = $data['section'];
                    }
                    $count = 0;
                    foreach ($data as $i=>$item) {
                        if (!is_array($item)) {
                            continue;
                        }
                        if (!isset($item['priority'])) {
                            $item['priority'] = $count;
                        }
                        if (!isset($item['id']) && is_string($i)) {
                            $item['id'] = $i;
                        }
                        $this->setSetting(
                            $item['id'],
                            $item,
                            $parent_id
                        );
                        $count++;
                    }
                    break;

                case 'setting':
                    if (is_null($parent_id) && isset($data['section'])) {
                        $parent_id = $data['section'];
                    }
                    $this->setSetting(
                        $data['id'],
                        $data,
                        $parent_id
                    );
                    break;

                case 'control':
                    if (is_null($parent_id) && isset($data['section'])) {
                        $parent_id = $data['section'];
                    }
                    if (!is_null($parent_id)) {
                        $this->setControl(
                            $data['id'],
                            $parent_id,
                            $data
                        );
                    }
                    break;
            }
        }
    }

    /**
     * Rebuild a panel data array
     *
     * @param array $data
     * @return array
     */
    public function getPanelData(array $data)
    {
        return array(
            'priority'          => isset($data['priority']) ? $data['priority'] : 160,
            'capability'        => isset($data['capability']) ? $data['capability'] : 'edit_theme_options',
            'theme_supports'    => isset($data['theme_supports']) ? $data['theme_supports'] : '',
            'title'             => isset($data['title']) ? __($data['title'], 'basicbootstrap') : '',
            'description'       => isset($data['description']) ? __($data['description'], 'basicbootstrap') : '',
            'active_callback'   => isset($data['active_callback']) ? $data['active_callback'] : '',
        );
    }

    /**
     * Handle a panel entry
     *
     * @param $id
     * @param array $data
     * @param array|null $sections
     */
    public function setPanel($id, array $data, array $sections = null)
    {
        $panel_data = $this->getPanelData($data);
        if (is_null($sections) && isset($data['sections'])) {
            $sections = $data['sections'];
        }

        $item = $this->customizer->get_panel($id);
        if ($item) {
            foreach ($data as $var=>$val) {
                if (array_key_exists($var, $panel_data)) {
                    $item->{$var} = $val;
                }
            }

        } else {
            $this->customizer->add_panel(
                new WP_Customize_Panel(
                    $this->customizer, $id, $panel_data
                )
            );
        }

        if (!is_null($sections)) {
            $sections['object'] = 'sections';
            $sections['panel'] = $id;
            $this->processData($sections);
        }
    }

    /**
     * Rebuild a section data array
     *
     * @param array $data
     * @param $panel_id
     * @return array
     */
    public function getSectionData(array $data, $panel_id = null)
    {
        return array(
            'panel'             => !is_null($panel_id) ? $panel_id : '',
            'priority'          => isset($data['priority']) ? $data['priority'] : 100,
            'capability'        => isset($data['capability']) ? $data['capability'] : 'edit_theme_options',
            'theme_supports'    => isset($data['theme_supports']) ? $data['theme_supports'] : '',
            'title'             => isset($data['title']) ? __($data['title'], 'basicbootstrap') : '',
            'description'       => isset($data['description']) ? __($data['description'], 'basicbootstrap') : '',
            'active_callback'   => isset($data['active_callback']) ? $data['active_callback'] : '',
        );
    }

    /**
     * Handle a section entry
     *
     * @param $id
     * @param array $data
     * @param array|null $settings
     * @param $panel_id
     */
    public function setSection($id, array $data, array $settings = null, $panel_id = null)
    {
        $section_data = $this->getSectionData($data, $panel_id);
        if (is_null($panel_id) && isset($data['panel'])) {
            $panel_id = $data['panel'];
        }
        if (is_null($settings) && isset($data['settings'])) {
            $settings = $data['settings'];
        }

        $item = $this->customizer->get_section($id);
        if ($item) {
            foreach ($data as $var=>$val) {
                if (array_key_exists($var, $section_data)) {
                    $item->{$var} = $val;
                }
                if (!empty($panel_id)) {
                    $item->panel = $panel_id;
                }
            }

        } else {
            $this->customizer->add_section(
                new WP_Customize_Section(
                    $this->customizer, $id, $section_data
                )
            );
        }

        if (!is_null($settings)) {
            $settings['object'] = 'settings';
            $settings['section'] = $id;
            $this->processData($settings);
        }
    }

    /**
     * Rebuild a setting data array
     *
     * @param array $data
     * @return array
     */
    public function getSettingData(array $data)
    {
        return array(
            'capability'        => isset($data['capability']) ? $data['capability'] : 'edit_theme_options',
            'transport'         => isset($data['transport']) ? $data['transport'] : 'postMessage',
            'type'              => isset($data['setting_type']) ? $data['setting_type'] : 'theme_mod',
            'sanitize_callback' => isset($data['sanitize_callback']) ? $data['sanitize_callback'] : '',
            'sanitize_js_callback' => isset($data['sanitize_js_callback']) ? $data['sanitize_js_callback'] : '',
            'default'           => isset($data['default']) ? $data['default'] : (
                                        isset($data['id']) ? $this->getDefault($data['id']) : ''
                                    ),
        );
    }

    /**
     * Handle a setting entry
     *
     * @param $id
     * @param array $data
     * @param null $section_id
     */
    public function setSetting($id, array $data, $section_id = null)
    {
        $setting_data = $this->getSettingData($data);
        if (is_null($section_id) && isset($data['section'])) {
            $section_id = $data['section'];
        }

        if (
            isset($data['control_type']) &&
            $data['control_type']=='select' &&
            (empty($data['sanitize_callback']) || $data['sanitize_callback'] == '')
        ) {
            $data['sanitize_callback'] = sanitize_select_generator(
                isset($data['choices']) ? $data['choices'] : array(),
                isset($data['default']) ? $data['default'] : null
            );
        }

        $item = $this->customizer->get_setting($id);
        if ($item) {
            foreach ($data as $var=>$val) {
                if (array_key_exists($var, $setting_data)) {
                    $item->{$var} = $val;
                } elseif ($var == 'setting_type') {
                    $item->type = $val;
                }
                if (!empty($section_id)) {
                    $item->section = $section_id;
                }
            }

        } else {
            $control_item = $this->customizer->get_control($id);
            if (empty($control_item)) {
                $this->customizer->add_setting(
                    new WP_Customize_Setting(
                        $this->customizer, $id, $setting_data
                    )
                );
            }

            if (!is_null($section_id)) {
                $this->setControl($id, $section_id, $data);
            }
        }
    }

    /**
     * Rebuild a control data
     *
     * @param $id
     * @param $section_id
     * @param array $data
     * @return array
     */
    public function getControlData($id, $section_id, array $data)
    {
        return array(
            'section'           => $section_id,
            'settings'          => $id,
            'priority'          => isset($data['priority']) ? $data['priority'] : 10,
            'label'             => isset($data['label']) ? __($data['label'], 'basicbootstrap') : '',
            'description'       => isset($data['description']) ? __($data['description'], 'basicbootstrap') : '',
            'type'              => isset($data['control_type']) ? $data['control_type'] : 'text',
            'choices'           => isset($data['choices']) ? $data['choices'] : array(),
            'input_attrs'       => isset($data['input_attrs']) ? $data['input_attrs'] : array(),
            'active_callback'   => isset($data['active_callback']) ? $data['active_callback'] : '',
        );
    }

    /**
     * Handle a control entry
     *
     * @param $id
     * @param $section_id
     * @param array $data
     * @throws \ErrorException If the `control_class` can not be found
     */
    public function setControl($id, $section_id, array $data)
    {
        $control_data = $this->getControlData($id, $section_id, $data);
        if (is_null($section_id) && isset($data['section'])) {
            $section_id = $data['section'];
        }

        $item = $this->customizer->get_control($id);
        if ($item) {
            foreach ($data as $var=>$val) {
                if (array_key_exists($var, $control_data)) {
                    $item->{$var} = $val;
                } elseif ($var == 'control_type') {
                    $item->type = $val;
                }
            }
            if (!is_null($section_id)) {
                $item->section = $section_id;
            }

        } else {
            if (!isset($data['control_type'])) {
                $data['control_type'] = 'text';
            }

            $cls = isset($data['control_class']) ? $data['control_class'] : null;
            if (is_null($cls)) {
                switch ($data['control_type']) {
                    case 'select':
                        $cls = 'WP_Customize_Control';
                        foreach ($data['choices'] as $var=>$val) {
                            $data['choices'][$var] = __($val, 'basicbootstrap');
                        }
                        break;
                    case 'checkbox':
                        $cls = 'WP_Customize_Control';
                        if (!isset($data['sanitize_callback'])) {
                            $data['sanitize_callback'] = 'sanitize_checkbox';
                        }
                        break;
                    case 'color':
                        $cls = 'WP_Customize_Color_Control';
                        if (!isset($data['sanitize_callback'])) {
                            $data['sanitize_callback'] = 'sanitize_hex_color';
                        }
                        break;
                    default:
                        $cls = 'WP_Customize_Control';
                        break;
                }
            }

            if (!class_exists($cls)) {
                throw new ErrorException(
                    sprintf('Customizer control class "%s" not found!', $cls)
                );
            }

            $this->customizer->add_control(
                new $cls(
                    $this->customizer, $id, $control_data
                )
            );
        }
    }
}
