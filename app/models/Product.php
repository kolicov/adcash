<?php
/**
 * Created by PhpStorm.
 * User: kolicov
 * Date: 3/13/16
 * Time: 10:25 PM
 */

namespace Models;

use Phalcon\Mvc\Model;

class Product extends Model
{
  protected $id = null;
  protected $title = null;
  protected $price = null;
  protected $description = null;

  /**
   * @return null
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param null $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return null
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param null $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * @return null
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @param null $title
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * @return null
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * @param null $price
   */
  public function setPrice($price) {
    $this->price = floatval($price);
  }

  public function getThumbnail() {
    $replaceOem = $this->modelsManager->createBuilder()
      ->from('Models\Images')
      ->leftJoin('Models\ProductImage', 'Models\Images.id = Models\ProductImage.image_id')
      ->where('Models\ProductImage.item_id', $this->id)
      ->orderBy('Models\Images.index')
      ->groupBy('Models\ProductImage.image_id')
      ->limit(1)
      ->getQuery()->execute();

    return $replaceOem;
  }

  public function getImages() {
    $replaceOem = $this->modelsManager->createBuilder()
      ->from('Models\Images')
      ->leftJoin('Models\ProductImage', 'Models\Images.id = Models\ProductImage.image_id')
      ->where('Models\ProductImage.item_id', $this->id)
      ->orderBy('Models\Images.index')
      ->groupBy('Models\ProductImage.image_id')
      ->getQuery()->execute();

    return $replaceOem;
  }

  public function initialize()
  {
    $this->hasManyToMany(
      "id", "Models\ProductImage", "item_id", "image_id", "Models\Images", "id", array('alias' => 'Images')
    );
  }
}