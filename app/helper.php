<?php
    
    use App\Models\area;


    if (!function_exists('find_area_by_id')) {
        function find_area_by_id($area_id)
        {
            if ($area_id != 0) {
                    $area_data = area::where('id', $area_id)->get();
                    $area_data_final = json_decode($area_data);
                    foreach ($area_data_final as $key) {
                    return $key->area_name;
                }
            }else{
                return "----";
            }
        }
    }

?>