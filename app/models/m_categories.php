<?php
/*
    Categories
    Handles all tasks related to retrieving and displaying categories
*/

class Categories
{
    private $database;
    private $db_table='categories';

    function __construct()
    {
        global $database;
        $this->database=$database;
    }

    /*
        Settting/Getting categories from database
    */

    /**
     * Return an array with category information
     * 
     * @access public
     * @param   int(optional)
     * @return array
     */
    public function get_categories($id=NULL)
    {
        $data=array();
        if($id != NULL)
        {
            // get specific category
            if($stmt=$this->database->prepare("SELECT id, name FROM " . $this->db_table . " WHERE id=? LIMIT 1"))
            {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();

                $stmt->bind_result($cat_id,$cat_name);
                $stmt->fetch();

                if($stmt->num_rows > 0)
                {
                    $data=array('id'=>$cat_id, 'name'=>$cat_name);
                }
                $stmt->close();

            }
        }
        else
        {
            // get all categories
            if($result=$this->database->query("SELECT * FROM " . $this->db_table . " ORDER BY name"))
            {
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_array())
                    {
                        $data[]=array('id'=>$row['id'], 'name'=>$row['name']);
                    }
                }
            }
        }
        return $data;
    }

    /*
        Create page parts
    */

    /**
     * Returns an unordered list of links to all category pages
     * 
     * @access public
     * @param string (optional)
     * @return string
     */

    public function create_category_nav($active = NULL)
    {
        // get all categories
        $categories=$this->get_categories();

        // set up 'all' item
        $data='<li';
        if($active == strtolower('home'))
        {
            $data .= ' class="active"';
        }
        $data .= '><a href="' . SITE_PATH . '">View All</a></li>';

        // loop through each category
        if (! empty($categories))
        {
            foreach($categories as $category)
            {
                $data .= '<li';
                if(strtolower($active) == strtolower($category['name']))
                {
                    $data .= ' class="active"';
                }
                $data .= '><a href="' . SITE_PATH . 'index.php?=' . $category['id'] . '">' . $category['name'] . '</a></li>';
            }
        }
        return $data;
    }

}

?>