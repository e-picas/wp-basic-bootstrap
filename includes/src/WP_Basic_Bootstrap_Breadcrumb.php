<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Class WP_Basic_Bootstrap_Breadcrumb
 */
class WP_Basic_Bootstrap_Breadcrumb
{
    protected $entries;

    public function render()
    {
        /* @var $post \WP_Post */
        global $post;
        $this->entries = array();
        $this->addHomePage();

        if (!is_front_page() && is_home()) {
            $show_on_front = get_option('show_on_front');
            if ($show_on_front == 'page') {
                $this->addBlogPage();
            }
        } elseif (is_tag()) {
            $this->addBlogPage();
            $tag_id = get_query_var('tag_id');
            $this->addTag($tag_id);
        } elseif (is_category()) {
            $this->addBlogPage();
            $cat_id = get_cat_id(single_cat_title('', false));
            $this->addCategory($cat_id);
        } elseif (is_author()) {
            $this->addAuthor(get_the_author_meta('ID'));
        } elseif (is_search()) {
            $this->addSearch(get_search_query());
        } elseif (is_page()) {
            $this->addPage($post->ID);
        } elseif (is_single()) {
            $post_type   = get_query_var('post_type');
            if ($post_type !== 'post') {
                $this->addPostType($post_type);
            } else {
                $this->addBlogPage();
            }
            $categories = get_the_category();
            if (isset($categories[0])) {
                $this->addCategory($categories[0]->cat_ID);
            }
            $this->addPost($post->ID);
        } elseif (is_401()) {
            $this->addErrorPage(401);
        } elseif (is_403()) {
            $this->addErrorPage(403);
        } elseif (is_404()) {
            $this->addErrorPage();
        } elseif (is_tax()) {
            $this->addBlogPage();
            $term   = get_query_var('term');
            $tax    = get_query_var('taxonomy');
            if ($tax == 'post_format') {
                $this->addPostFormat($term);
            }
        } elseif ( is_post_type_archive() ) {
            $post_type   = get_query_var('post_type');
            $this->addPostType($post_type);
        } elseif (is_archive()) {
            $this->addBlogPage();
            $this->addDate(
                (is_year() || is_month() || is_day()) ? get_the_time('Y') : false,
                (is_year() || is_month()) ? get_the_time('m') : false,
                is_day() ? get_the_time('d') : false
            );
        }

        /**
         * FILTER - Filter the array of breadcrumb entries
         */
        $this->entries = apply_filters('WPBB_breadcrumb_entries_filter', $this->entries);

        return $this->entries;
    }

    public function addHomePage($default_title = null)
    {
        $show_on_front  = get_option('show_on_front');
        $front_page     = get_option('page_on_front');
        if ($show_on_front == 'page') {
            $posts_page     = get_post($front_page);
            $this->entries[] = array(
                'title' => !is_null($default_title) ? $default_title : $posts_page->post_title,
                'url'   => get_home_url() . '/' . get_page_uri($front_page),
            );
        } else {
            $this->entries[] = array(
                'title' => __('Home', 'basicbootstrap'),
                'url'   => get_home_url(),
            );
        }
    }

    public function addBlogPage($default_title = null)
    {
        $show_on_front  = get_option('show_on_front');
        $blog_page      = get_option('page_for_posts');
        if ($show_on_front == 'page') {
            $posts_page     = get_post($blog_page);
            $this->entries[] = array(
                'title' => !is_null($default_title) ? $default_title : (!empty($posts_page) ? $posts_page->post_title : ''),
                'url'   => get_home_url() . '/' . get_page_uri($blog_page),
            );
        }
    }

    public function addErrorPage($status = 404)
    {
        switch ($status) {
            case 401:
                $title = __('401 Unauthorized', 'basicbootstrap');
                break;
            case 403:
                $title = __('403 Forbidden Access', 'basicbootstrap');
                break;
            default:
                $title = __('404 Not Found', 'basicbootstrap');
        }
        $this->entries[] = array(
            'title' => $title,
            'url'   => null,
        );
    }

    public function addPost($id)
    {
        $this->entries[] = array(
            'title' => get_the_title($id),
            'url'   => get_permalink($id),
        );
    }

    public function addPage($id, $parents = true)
    {
        if ($parents) {
            $post = get_post($id);
            if ($post->post_parent) {
                $anc = get_post_ancestors($post->ID);
                $anc = array_reverse($anc);
                foreach ($anc as $ancestor) {
                    $this->addPage($ancestor, false);
                }
            }
        }
        $this->addPost($id);
    }

    public function addCategory($id, $parents = true)
    {
        if ($parents) {
            $parents_names = explode('/', trim(get_category_parents($id), '/'));
            array_pop($parents_names);
            foreach ($parents_names as $name) {
                $this->addCategory(get_cat_ID($name), false);
            }
        }
        $this->entries[] = array(
            'title' => get_cat_name($id),
            'url'   => get_category_link($id),
        );
    }

    public function addTag($id)
    {
        $terms              = get_terms('post_tag', 'include=' . $id);
        $this->entries[]    = array(
            'title' => __('Tags', 'basicbootstrap'),
            'url'   => null,
        );
        $this->entries[]    = array(
            /* translators: #tag-name */
            'title' => sprintf(__('#%s', 'basicbootstrap'), $terms[0]->name),
            'url'   => get_tag_link($id),
        );
    }

    public function addPostFormat($term)
    {
        $term_object = get_term_by('slug', $term, 'post_format');
        $this->entries[]    = array(
            'title' => __('Post Formats', 'basicbootstrap'),
            'url'   => null,
        );
        $this->entries[]    = array(
            'title' => __($term_object->name, 'basicbootstrap'),
            'url'   => get_tag_link($term_object->term_id),
        );
    }

    public function addSearch($query)
    {
        $this->entries[] = array(
            'title' => sprintf(__('Search: "%s"', 'basicbootstrap'), $query),
            'url'   => get_search_link($query),
        );
    }

    public function addDate($year = false, $month = false, $day = false)
    {
        if ($year) {
            $this->addYear($year);
            if ($month) {
                $this->addMonth($year, $month);
                if ($day) {
                    $this->addDay($year, $month, $day);
                }
            }
        }
    }

    public function addYear($year)
    {
        $this->entries[] = array(
            'title' => $year,
            'url'   => get_year_link($year)
        );
    }

    public function addMonth($year, $month)
    {
        $this->entries[] = array(
            'title' => date_i18n('F', strtotime('01-'.$month.'-'.$year)),
            'url'   => get_month_link($year, $month)
        );
    }

    public function addDay($year, $month, $day)
    {
        $this->entries[] = array(
            'title' => $day,
            'url'   => get_day_link($year, $month, $day)
        );
    }

    public function addAuthor($id)
    {
        $this->entries[]    = array(
            'title' => __('Authors', 'basicbootstrap'),
            'url'   => null,
        );
        $userdata = get_userdata($id);
        $this->entries[] = array(
            'title' => $userdata->display_name,
            'url'   => get_author_posts_url($id),
        );
    }

    public function addPostType($post_type)
    {
        $post_type_object = get_post_type_object($post_type);
        if (is_object($post_type_object) && $post_type_object instanceof WP_Post_Type) {
            $this->entries[] = array(
                'title' => $post_type_object->labels->name,
                'url'   => get_post_type_archive_link($post_type),
            );

        }
    }
}
