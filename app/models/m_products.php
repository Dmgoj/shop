<?php

/*
    Product Class
    Handles all tasks related to retrieving and displaying products
*/

class Products
{
    private $database;
    private $db_table='products';

    function __construct()
    {
        global $database;
        $this->database=$database;
    }

    /*
        Getters / Setters
    */

    /**
     * Retrieve producti information from database
     * 
     * @access public
     * @param int (optional)
     * @return array
     */
    public function get($id=NULL)
    {
        $data=array();

        if(is_array($id))
        {
            // get products based on array of ids
        }
        else if ($id != NULL)
        {
            // get one specific product
            if($stmt=$this->database->prepare("SELECT
                $this->db_table.id,
                $this->db_table.name,
                $this->db_table.description,
                $this->db_table.price,
                $this->db_table.image,
                categories.name AS category_name
                FROM $this->db_table, categories
                WHERE $this->db_table.id=? AND $this->db_table.category_id = 
                categories.id"))
                {
                    $stmt->bind_param("i",$id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($prod_id, $prod_name, $prod_description, $prod_price, $prod_image, $cat_name);
                    $stmt->fetch();

                    if($stmt->num_rows>0)
                    {
                        $data=array('id'=>$prod_id, 'name'=>$prod_name, 'description'=>$prod_description, 'price'=>$prod_price, 'image'=>$prod_image, 'category_name'=>$cat_name);
                    }
                    $stmt->close();
                }
        }
        else
        {
            // get all products
        }
        return $data;
    }

}

?>