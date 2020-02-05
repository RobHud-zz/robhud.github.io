<?php
class ControllerCommonSearch extends Controller {
	public function index() {
		$this->load->language('common/search');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

        $data['theme_url'] = '/catalog/view/theme/sushi';

		return $this->load->view('common/search', $data);
	}
}
