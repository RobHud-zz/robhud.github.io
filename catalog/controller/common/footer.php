<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		$data['open'] = $this->config->get('config_open');

        $data['telephones'] = array(
            array('title' => $this->config->get('config_telephone'), 'link' => str_replace(array('(', ')', '-', ' ', '+'), '', $this->config->get('config_telephone'))),
            array('title' => $this->config->get('config_telephone2'), 'link' => str_replace(array('(', ')', '-', ' ', '+'), '', $this->config->get('config_telephone2'))),
        );

        $data['socials'] = array(
            'facebook' => $this->config->get('config_facebook'),
            'telegram' => $this->config->get('config_telegram'),
            'viber' => $this->config->get('config_viber'),
            'instagram' => $this->config->get('config_instagram'),
        );

		$data['theme_url'] = '/catalog/view/theme/sushi';
        $data['guide'] = $this->url->link('information/guide', '', true);
        $data['comments'] = $this->url->link('information/comments', '', true);

        $data['search_action'] = html_entity_decode($this->url->link('product/search', 'search=', true));

        $data['ajax_send_url'] = $this->url->link('common/footer/send', '', 'SSL');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		$data['scripts'] = $this->document->getScripts('footer');
		
		return $this->load->view('common/footer', $data);
	}

    public function send() {
        $this->load->language('common/footer');

        $error = array();
        $success = '';

        $this->request->post['telephone'] = str_replace('_', '', $this->request->post['telephone']);

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $error['name'] = $this->language->get('error_name');
        }

        if (utf8_strlen($this->request->post['telephone']) != 19) {
            $error['telephone'] = $this->language->get('error_telephone');
        }

        if ((utf8_strlen($this->request->post['comment']) < 10) || (utf8_strlen($this->request->post['comment']) > 3000)) {
            $error['comment'] = $this->language->get('error_comment');
        }

        if (! $error) {
            $mail = new Mail($this->config->get('config_mail_engine'));
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name'], $this->request->post['telephone']), ENT_QUOTES, 'UTF-8'));
            $mail->setText($this->request->post['comment']);
            $mail->send();

            $success = $this->language->get('text_success');
        }

        $json = array('error' => $error, 'success' => $success);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
