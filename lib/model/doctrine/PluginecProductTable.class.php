<?php

/**
 * PluginecProductTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginecProductTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PluginecProductTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('PluginecProduct');
  }

  public function addTranslation(Doctrine_Query $q) {
    $q->leftJoin($q->getRootAlias() . '.Translation t');
    return $q;
  }
  
  public function buildQuery($params = NULL, $query = true) {

    $dql = Doctrine_Query::create()
      ->from('ecProduct p')
      ->leftJoin('p.Translation t')
      ->where('t.lang = ?', mdLanguage::getLanguage());

    if (array_key_exists('name', $params)) {
      $dql->addWhere('t.name LIKE ?', "%" . $params['name'] . "%");
    }
    
    if (array_key_exists('categorias_ids', $params)) {
      $dql = $dql->leftJoin('p.ecProductToCategory c')
        ->whereIn('c.ec_category_id', $params['categorias_ids']);
    }

    if (array_key_exists('marcas_ids', $params)) {
      $dql = $dql->leftJoin('p.ecManufacturer m')
        ->whereIn('p.ec_manufacturer_id', $params['marcas_ids']);
    }

    if (array_key_exists('precio', $params)) {
      if (array_key_exists('min', $params['precio'])) {
        $dql = $dql->andWhere('p.price > ?', $params['precio']['min']);
      }

      if (array_key_exists('max', $params['precio'])) {
        $dql = $dql->andWhere('p.price < ?', $params['precio']['max']);
      }
    }

    if ($query)
      return $dql;

    return $dql->execute();
  }

  public function findBestSales($limit = 10) {
    return $this->createQuery('p')
      ->leftJoin('p.Translation t')
      ->where('p.active = 1')
      ->orderBy('p.sales desc')
      ->limit($limit)
      ->execute();
  }
  
  public function findDestacados($query = false, $limit = 10) {
    $q = $this->createQuery('p')
      ->leftJoin('p.Translation t')
      ->where('p.highlight = 1')
      ->andWhere('p.active = 1')
      ->orderBy('p.viewed desc');
    
    if($query) return $query;
    
    return $q->limit($limit)->execute();
  }
  
  public function findRelacionados($ecProduct, $category_ids, $limit = 15, $query = false) {
    $q = $this->createQuery('p')
      ->leftJoin('p.Translation t')
      ->leftJoin('p.ecProductToCategory c')
      ->whereIn('c.ec_category_id', $category_ids)
      ->andWhere('p.id <> ?', $ecProduct->getId())
      ->andWhere('p.active = 1');
      
    if($query) return $q;
    
    return  $q->limit($limit)->execute();
  }  

  public function findRecientes($query = false, $limit = 10) {
    $q = $this->createQuery('p')
      ->leftJoin('p.Translation t')
      ->where('p.active = 1')
      ->orderBy('p.created_at desc');
    
    if($query) return $query;
    
    return $q->limit($limit)->execute();
  }

}