<?php
class ControllerCheckoutCheckout extends Controller {
	public function index() {
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$this->response->redirect($this->url->link('checkout/cart'));
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}

		$this->load->language('checkout/checkout');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		// Required by klarna
		if ($this->config->get('payment_klarna_account') || $this->config->get('payment_klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);

		$data['text_checkout_option'] = sprintf($this->language->get('text_checkout_option'), 1);
		$data['text_checkout_account'] = sprintf($this->language->get('text_checkout_account'), 2);
		$data['text_checkout_payment_address'] = sprintf($this->language->get('text_checkout_payment_address'), 2);
		$data['text_checkout_shipping_address'] = sprintf($this->language->get('text_checkout_shipping_address'), 3);
		$data['text_checkout_shipping_method'] = sprintf($this->language->get('text_checkout_shipping_method'), 4);
		
		if ($this->cart->hasShipping()) {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 5);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 6);
		} else {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 3);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 4);	
		}

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();
		
		$data['theme_url'] = '/catalog/view/theme/sushi';
		
		$data['ajax_url'] = $this->url->link('checkout/checkout/confirm', '', 'SSL');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('checkout/checkout', $data));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function confirm() {
		$this->load->language('checkout/cart');
		
		$error = '';
		$success = '';
		$redirect = '';
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$error = $this->language->get('error_name');
		}
		
		if (utf8_strlen($this->request->post['phone']) != 19) {
			$error .= ($error ? '<br />' : '') . $this->language->get('error_phone');
		}
		
		// Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$error .= ($error ? '<br />' : '') . $this->language->get('error_stock');
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$error .= ($error ? '<br />' : '') . $this->language->get('error_minimum');

				break;
			}
		}
		
		if (! $error) {
			$order_data = array();

			$totals = array();
			$taxes = $this->cart->getTaxes();
			$total = 0;

			// Because __call can not keep var references so we put them into an array.
			$total_data = array(
				'totals' => &$totals,
				'taxes'  => &$taxes,
				'total'  => &$total
			);

			$this->load->model('setting/extension');

			$sort_order = array();

			$results = $this->model_setting_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get('total_' . $value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get('total_' . $result['code'] . '_status')) {
					$this->load->model('extension/total/' . $result['code']);

					// We have to put the totals in an array so that they pass by reference.
					$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
				}
			}

			$sort_order = array();

			foreach ($totals as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $totals);

			$order_data['totals'] = $totals;

			$this->load->language('checkout/checkout');

			$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
			$order_data['store_id'] = $this->config->get('config_store_id');
			$order_data['store_name'] = $this->config->get('config_name');

			if ($order_data['store_id']) {
				$order_data['store_url'] = $this->config->get('config_url');
			} else {
				if ($this->request->server['HTTPS']) {
					$order_data['store_url'] = HTTPS_SERVER;
				} else {
					$order_data['store_url'] = HTTP_SERVER;
				}
			}
			
			$this->load->model('account/customer');
			
			$order_data['customer_id'] = 0;
			$order_data['customer_group_id'] = $this->config->get('config_customer_group_id');
			$order_data['firstname'] = $this->request->post['name'];
			$order_data['lastname'] = '';
			$order_data['email'] = '';
			$order_data['telephone'] = $this->request->post['phone'];
			$order_data['custom_field'] = array();

			$order_data['payment_firstname'] = '';
			$order_data['payment_lastname'] = '';
			$order_data['payment_company'] = '';
			$order_data['payment_address_1'] = $this->request->post['address'];
			$order_data['payment_address_2'] = '';
			$order_data['payment_city'] = '';
			$order_data['payment_postcode'] = '';
			$order_data['payment_zone'] = '';
			$order_data['payment_zone_id'] = '';
			$order_data['payment_country'] = '';
			$order_data['payment_country_id'] = '';
			$order_data['payment_address_format'] = '';
			$order_data['payment_custom_field'] = array();
			
			$this->load->language('extension/payment/' . $this->request->post['payment_method']);
			
			$order_data['payment_method'] = $this->language->get('text_title');
			$order_data['payment_code'] = $this->request->post['payment_method'];
			
			$order_data['shipping_firstname'] = '';
			$order_data['shipping_lastname'] = '';
			$order_data['shipping_company'] = '';
			$order_data['shipping_address_1'] = '';
			$order_data['shipping_address_2'] = '';
			$order_data['shipping_city'] = '';
			$order_data['shipping_postcode'] = '';
			$order_data['shipping_zone'] = '';
			$order_data['shipping_zone_id'] = '';
			$order_data['shipping_country'] = '';
			$order_data['shipping_country_id'] = '';
			$order_data['shipping_address_format'] = '';
			$order_data['shipping_custom_field'] = array();
			$order_data['shipping_method'] = '';
			$order_data['shipping_code'] = '';

			$order_data['products'] = array();

			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();

				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'product_option_id'       => $option['product_option_id'],
						'product_option_value_id' => $option['product_option_value_id'],
						'option_id'               => $option['option_id'],
						'option_value_id'         => $option['option_value_id'],
						'name'                    => $option['name'],
						'value'                   => $option['value'],
						'type'                    => $option['type']
					);
				}

				$order_data['products'][] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => $option_data,
					'download'   => $product['download'],
					'quantity'   => $product['quantity'],
					'subtract'   => $product['subtract'],
					'price'      => $product['price'],
					'total'      => $product['total'],
					'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
					'reward'     => $product['reward']
				);
			}

			// Gift Voucher
			$order_data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $voucher) {
					$order_data['vouchers'][] = array(
						'description'      => $voucher['description'],
						'code'             => token(10),
						'to_name'          => $voucher['to_name'],
						'to_email'         => $voucher['to_email'],
						'from_name'        => $voucher['from_name'],
						'from_email'       => $voucher['from_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'],
						'message'          => $voucher['message'],
						'amount'           => $voucher['amount']
					);
				}
			}

			$order_data['comment'] = $this->request->post['comment'];
			$order_data['total'] = $total_data['total'];

			if (isset($this->request->cookie['tracking'])) {
				$order_data['tracking'] = $this->request->cookie['tracking'];

				$subtotal = $this->cart->getSubTotal();

				// Affiliate
				$affiliate_info = $this->model_account_customer->getAffiliateByTracking($this->request->cookie['tracking']);

				if ($affiliate_info) {
					$order_data['affiliate_id'] = $affiliate_info['customer_id'];
					$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
				} else {
					$order_data['affiliate_id'] = 0;
					$order_data['commission'] = 0;
				}

				// Marketing
				$this->load->model('checkout/marketing');

				$marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

				if ($marketing_info) {
					$order_data['marketing_id'] = $marketing_info['marketing_id'];
				} else {
					$order_data['marketing_id'] = 0;
				}
			} else {
				$order_data['affiliate_id'] = 0;
				$order_data['commission'] = 0;
				$order_data['marketing_id'] = 0;
				$order_data['tracking'] = '';
			}

			$order_data['language_id'] = $this->config->get('config_language_id');
			$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
			$order_data['currency_code'] = $this->session->data['currency'];
			$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
			$order_data['ip'] = $this->request->server['REMOTE_ADDR'];

			if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
				$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
			} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
				$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
			} else {
				$order_data['forwarded_ip'] = '';
			}

			if (isset($this->request->server['HTTP_USER_AGENT'])) {
				$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
			} else {
				$order_data['user_agent'] = '';
			}

			if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
				$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
			} else {
				$order_data['accept_language'] = '';
			}

			$this->load->model('checkout/order');

			$order_id = $this->model_checkout_order->addOrder($order_data);
			
			$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('config_order_status_id'));
			
			$this->cart->clear();
			
			$redirect = $this->url->link('common/home');
			
			unset( $this->session->data['coupon'] );
			
			$success = $this->language->get('text_alert_success');
		}
		
		$json = array('error' => $error, 'success' => $success, 'redirect' => $redirect);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}