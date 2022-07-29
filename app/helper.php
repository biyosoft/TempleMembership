<?php
    
    use App\Models\area;
    use App\Models\membership;
    use Illuminate\Support\Facades\DB;

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

    if (!function_exists('get_all_members')) {
        function get_all_members()
        {
            // $data = DB::table('memberships')->get();
            // $data = DB::select('select * from `memberships` group by `gvBrowseAttention`');
            // $data = membership::select('id', 'gvBrowseAttention')->groupBy('gvBrowseAttention')->get();
            $data = membership::select('id', 'gvBrowseAttention')
                ->groupBy('gvBrowseAttention')
                ->get();
            return $data;
        }
    }

?>