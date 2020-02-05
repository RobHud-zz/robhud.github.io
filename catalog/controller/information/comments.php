<?php
class ControllerInformationComments extends Controller {
	public function index() {
		$this->load->language('information/comments');
		
		$this->load->model('tool/image');
		
		$this->load->model('catalog/review');
		
        $this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('information/comments')
        );
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$limit = 5;
		
		$start = ($page - 1) * $limit;
		
		$review_total = $this->model_catalog_review->getTotalReviews();
		
		$results = $this->model_catalog_review->getReviews( $start, $limit );

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
			}
			
			$card = substr( $result['card'], 0, 4 );
			
			$date = date( 'd/m/Y', strtotime( $result['date_added'] ) );
			
			$data['reviews'][] = array(
				'thumb'       => $image,
				'author'      => $result['author'],
				'card'        => $card,
				'response'    => $result['response'],
				'text'        => $result['text'],
				'date'        => $date,
			);
		}
		
		$pagination = new ThemePagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('information/comments', 'page={page}');

		$data['pagination'] = $pagination->render();
		
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['theme_url'] = '/catalog/view/theme/sushi';	
		$data['ajax_url'] = $this->url->link('information/comments/write', '', true);		
		
		$this->response->setOutput($this->load->view('information/comments', $data));
	}
	
	public function write() {
		$this->load->language('information/comments');

		$json = array();
		$json['error'] = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 25)) {
				$json['error']['author'] = $this->language->get('error_author');
			}

			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error']['text'] = $this->language->get('error_text');
			}
			
			if ( !isset( $this->request->files['photo'] ) || ! is_uploaded_file( $this->request->files['photo']['tmp_name'] ) ) {
				$json['error']['photo'] = $this->language->get('error_photo');
			}
			
			if ( isset( $this->request->files['photo'] ) && filesize( $this->request->files['photo']['tmp_name'] ) > 10485760 ) {
				$json['error']['photo'] = $this->language->get('error_photo_size');
			}
			
			if ( isset( $this->request->files['photo'] ) && ! exif_imagetype( $this->request->files['photo']['tmp_name'] ) ) {
				$json['error']['photo'] = $this->language->get('error_photo_type');
			}

			// Captcha
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if ( ! $json['error'] ) {
				$uploads_dir = DIR_IMAGE . 'catalog/reviews/';
				move_uploaded_file( $this->request->files['photo']['tmp_name'], $uploads_dir . $this->request->files['photo']['name'] );
				
				$this->request->post['image'] = 'catalog/reviews/' . $this->request->files['photo']['name'];
				
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview( $this->request->post );

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json, JSON_UNESCAPED_UNICODE));
	}
}
