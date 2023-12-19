<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

class WP_Basic_Bootstrap_Pagination
{
    public $type = 'simple';
    protected $entries;

    public function render($in_category = false)
    {
        $add_args = [];
        $this->entries = array();

        $cats = get_the_category();
        if (count($cats)>0) {
            $add_args['category__and'] = $cats[0]->term_id;
        }

        if (is_attachment()) {
        } elseif (is_single()) {
            $this->entries = array(
                'previous'  => get_previous_post($add_args),
                'next'      => get_next_post($add_args),
            );

//        } elseif (is_archive() || is_search()) {
        } else {
            $this->type = 'numerical';
            $this->get_pagenav_num($add_args);
        }

        return $this->entries;
    }


    public function renderPostPages()
    {
        $this->entries = array();
        global $multipage;

        if (is_single() && $multipage) {
            $this->type = 'post_inner_pages';
            $this->get_post_pages_num();
        }

        return $this->entries;
    }

    /**
     * Get query page
     */
    protected function get_paged_query()
    {
        global $wp;
        $page = 1;
        $qpaged = get_query_var('paged');
        if (!empty($qpaged)) {
            $page = $qpaged;
        } else {
            $qpaged = wp_parse_args($wp->matched_query);
            if (isset($qpaged['paged']) && $qpaged['paged'] > 0) {
                $page = $qpaged['paged'];
            }
        }
        return $page;
    }

    /**
     * Process page navigation
     */
    protected function get_pagenav_num()
    {
        /* @var $wp_query \WP_Query */
        global $wp_query;

        // number of pages
        $max_page = intval($wp_query->max_num_pages);

        // if a pagination is needed
        if ($max_page > 1) {

            // number of pages to show before & after current one
            $pager_limit = intval(get_basicbootstrap_mod('numerical_pagination_limit'));

            // number of posts per page
            $pager_size = intval(get_query_var('posts_per_page'));

            // current page
            $paged = intval($this->get_paged_query());
            if (empty($paged) || $paged == 0) {
                $paged = 1;
            }

            // first page to show
            $start_page = intval($paged - $pager_limit);
            if ($start_page <= 0) {
                $start_page = 1;
            }

            // last page to show
            $end_page = intval($paged + $pager_limit);
            if ($end_page > $max_page) {
                $end_page = $max_page;
            }

            $this->entries = array(
                'paged'         => $paged,          // current page
                'start_page'    => $start_page,     // first page to show
                'end_page'      => $end_page,       // last page to show
                'max_page'      => $max_page,       // total number of pages
                'pager_size'    => $pager_size,     // limit of each page
            );
        }
    }

    protected function get_post_pages_num()
    {
        global $numpages, $multipage, $page;
        if ($multipage) {
            $this->entries['paged']     = $page;
            $this->entries['max_page']  = $numpages;
        }
    }
}
