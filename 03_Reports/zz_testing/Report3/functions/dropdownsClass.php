<?php

class Dropdown {
    public $card_type = "";
    public $branch_name = "";
    public $zone_name = "";
    public $region = "";
    public $product_type = "";
    public $model_type = "";
    public $model_version = "";
    public $sales_channel = "";

    function set_product_type_name($product_type) {
        $this->product_type = $product_type;
    }

    function get_product_type_name(){
        return $this->product_type;
    }

    function get_product_type_names() {
        $sql = "select product_type_display
            from prepare_master_step2
            group by product_type_display
            order by product_type_display asc";
        return $sql;
    }

    function set_model_type($model_type) {
        $this->model_type = $model_type;
    }

    function get_model_type() {
        return $this->model_type;
    }

    function get_model_types() {
        $sql = "select model_type_display
            from prepare_master_step2
            group by model_type_display
            order by model_type_display asc";
        return $sql;
    }

    function set_region_name($region) {
        $this->region = $region;
    }

    function get_region_name() {
        return $this->region;
    }

    function get_regions() {
        $sql = "select region_name_display
            from prepare_master_step2
            group by region_name_display
            order by region_name_display asc";
        return $sql;
    }

    function set_zone_name($zone) {
        $this->zone_name = $zone;
    }

    function get_zone_name() {
        return $this->region;
    }

    function get_zone_names() {
        $sql = "select zone_name_display
        from prepare_master_step2
        group by zone_name_display
        order by zone_name_display asc";

        return $sql;
    }

    function set_branch_name($branch_name) {
        $this->branch_name = $branch_name;
    }

    function get_branch_name() {
        return $this->branch_name;
    }

    function get_branchs() {
        $sql = "select branch_name_display
        from prepare_master_step2
        group by branch_name_display
        order by branch_name_display asc";

        return $sql;
    }

    function set_card_type($card_type) {
        $this->card_type = $type;
    }

    function get_card_type() {
        return $this->card_type;
    }

    function set_model_version($model_version) {
        $this->model_version = $model_version;
    }

    function get_model_version() {
        return $this->model_version;
    }

    function get_model_versions() {
        $sql = "select model_version_display
            from prepare_master_step2
            group by model_version_display
            order by model_version_display asc";
        return $sql;
    }

    function set_sales_channel($sales_channel) {
        $this->sales_channel = $sales_channel;
    }

    function get_sales_channel() {
        return $this->sales_channel;
    }

    function get_sales_channels() {
        $sql = "select sales_channel_display
            from prepare_master_step2
            group by sales_channel_display
            order by sales_channel_display";
        return $sql;
    }
}
?>