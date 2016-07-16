<?php
class ControllerModuleFiltercat extends Controller {
	protected function index($setting) {
		$this->load->model('catalog/filtercat');
		$this->data['products'] = array();
		
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/latest.tpl';
		} else {
			$this->template = 'default/template/module/latest.tpl';
		}

		$this->render();
	}
	public function models() {
		$this->load->model('catalog/filtercat');

		$man_id = $this->request->post['man_id'];

		$results = $this->model_catalog_filtercat->getModels($man_id);

		$models = array();
		foreach ($results as $result) {
			$models[] = array(
				'category_id' => $result['category_id'],
				'name' => $result['name']
			);
		}

		$this->response->setOutput(json_encode($models));		
	}

	public function years() {
		$this->load->model('catalog/filtercat');

		$model_id = $this->request->post['model_id'];

		$results = $this->model_catalog_filtercat->getYears($model_id);

		$years = array();
		foreach ($results as $result) {
			$years[] = array(
				'category_id' => $result['category_id'],
				'name' => $result['name']
			);
		}

		$this->response->setOutput(json_encode($years));		
	}

	public function table() {
		$this->load->model('catalog/category');

		$cat_id = $this->request->post['cat_id'];

		$results = $this->model_catalog_category->getCategory($cat_id);
		
		$json = array(
			'description' => html_entity_decode($results['description'])
		);

		$this->response->setOutput(json_encode($json));		
	}

}
?>