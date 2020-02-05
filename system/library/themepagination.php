<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
 */

/**
 * Pagination front class
 */
class ThemePagination {
    public $total = 0;
    public $page = 1;
    public $limit = 20;
    public $num_links = 3;
    public $url = '';
    public $text_first = '|&lt;';
    public $text_last = '&gt;|';
    public $text_next = '<button class="pagination__next"></button>';
    public $text_prev = '<button class="pagination__prev"></button>';

    /**
     *
     *
     * @return	text
     */
    public function render() {
        $total = $this->total;

        if ($this->page < 1) {
            $page = 1;
        } else {
            $page = $this->page;
        }

        if (!(int)$this->limit) {
            $limit = 10;
        } else {
            $limit = $this->limit;
        }

        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

        $this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

        $output = '<section class="pagination">';

        if ($page > 1) {
            if ($page - 1 === 1) {
                $output .= '<a href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">' . $this->text_prev . '</a>';
            } else {
                $output .= '<a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a>';
            }
        }

        $output .= '<div class="bamboo pagination__bamboo">';
		
		if ($num_pages <= $num_links) {
			$start = 1;
			$end = $num_pages;
		} else {
			$start = $page - floor($num_links / 2);
			$end = $page + floor($num_links / 2);

			if ($start < 1) {
				$end += abs($start) + 1;
				$start = 1;
			}

			if ($end > $num_pages) {
				$start -= ($end - $num_pages);
				$end = $num_pages;
			}
		}
		
        if ($page > 2 && $num_pages > 3) {
            $output .= '<div class="bamboo__cell pagination__cell"><a class="pagination__link" href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">1</a></div>';
        }

        if ($page > 3 && $start - 1 >= 2) {
            $output .= '<div class="bamboo__cell pagination__cell"><span class="pagination__link" href="#">...</span></div>';
        }

        if ($num_pages > 1) {
            for ($i = $start; $i <= $end; $i++) {
                if ($page == $i) {
                    $output .= '<div class="bamboo__cell pagination__cell"><span class="pagination__link pagination__link--current">' . $i . '</span></div>';
                } else {
                    if ($i === 1) {
                        $output .= '<div class="bamboo__cell pagination__cell"><a class="pagination__link" href="' . str_replace(array('&amp;page={page}', '?page={page}', '&page={page}'), '', $this->url) . '">' . $i . '</a></div>';
                    } else {
                        $output .= '<div class="bamboo__cell pagination__cell"><a class="pagination__link" href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></div>';
                    }
                }
            }
        }

        if ($page < $num_pages - 2 && $num_pages - $end >= 2) {
            $output .= '<div class="bamboo__cell pagination__cell"><span class="pagination__link" href="#">...</span></div>';
        }

        if ($page < $num_pages - 1  && $num_pages > 3) {
            $output .= '<div class="bamboo__cell pagination__cell"><a class="pagination__link" href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $num_pages . '</a></div>';
        }

        $output .= '</div>';

        if ($page < $num_pages) {
            $output .= '<li><a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a></li>';
        }

        $output .= '</section>';

        if ($num_pages > 1) {
            return $output;
        } else {
            return '';
        }
    }
}
