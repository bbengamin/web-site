<?php
class ModelCatalogFiltercat extends Model {
	public function getManufacturers() {
		$query = $this->db->query("SELECT category.category_id, cat_name.name FROM " . DB_PREFIX . "category as category LEFT JOIN " . DB_PREFIX . "category_description as cat_name ON category.category_id=cat_name.category_id WHERE  category.parent_id=20 ORDER BY cat_name.name");
		
		return $query->rows;
	}

	public function getModels($man_id) {
		$query = $this->db->query("SELECT category.category_id, cat_name.name FROM " . DB_PREFIX . "category as category LEFT JOIN " . DB_PREFIX . "category_description as cat_name ON category.category_id=cat_name.category_id WHERE category.parent_id=(SELECT DISTINCT category.category_id FROM " . DB_PREFIX . "category as category LEFT JOIN " . DB_PREFIX . "category_description as cat_name ON category.category_id=cat_name.category_id WHERE cat_name.name='Модель' AND category.parent_id=" . (int)$man_id . ")");
		
		return $query->rows;
	}


	public function getYears($model_id) {
		$query = $this->db->query("SELECT category.category_id, cat_name.name FROM " . DB_PREFIX . "category as category LEFT JOIN " . DB_PREFIX . "category_description as cat_name ON category.category_id=cat_name.category_id WHERE category.parent_id=(SELECT DISTINCT category.category_id FROM " . DB_PREFIX . "category as category LEFT JOIN " . DB_PREFIX . "category_description as cat_name ON category.category_id=cat_name.category_id WHERE cat_name.name='Год' AND category.parent_id=" . (int)$model_id . ")");
		
		return $query->rows;
	}
}
?>