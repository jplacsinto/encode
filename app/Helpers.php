<?php

function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

/**
 * URL before:
 * https://example.com/orders/123?order=ABC009&status=shipped
 *
 * 1. remove_query_params(['status'])
 * 2. remove_query_params(['status', 'order'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009
 * 2. https://example.com/orders/123
 */
function remove_query_params(array $params = [])
{
    $url = url()->current(); // get the base URL - everything to the left of the "?"
    $query = request()->query(); // get the query parameters (what follows the "?")

    foreach($params as $param) {
        unset($query[$param]); // loop through the array of parameters we wish to remove and unset the parameter from the query array
    }

    return $query ? $url . '?' . http_build_query($query) : $url; // rebuild the URL with the remaining parameters, don't append the "?" if there aren't any query parameters left
}

/**
 * URL before:
 * https://example.com/orders/123?order=ABC009
 *
 * 1. add_query_params(['status' => 'shipped'])
 * 2. add_query_params(['status' => 'shipped', 'coupon' => 'CCC2019'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009&status=shipped
 * 2. https://example.com/orders/123?order=ABC009&status=shipped&coupon=CCC2019
 */
function add_query_params(array $params = [])
{
    $query = array_merge(
        request()->query(),
        $params
    ); // merge the existing query parameters with the ones we want to add

    return url()->current() . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}



//creates sorting functionality for table header
function make_sortable($colName, $colTitle)
{
    $currSort = request()->get('sort', 'desc');
    $currCol = request()->get('col', 'id');

    $action = url(add_query_params(['sort'=> 'desc', 'col'=>$colName]));
        
    $icon = '';
    if($currSort == 'asc' && $currCol == $colName){
        $action = url(add_query_params(['sort'=> 'desc', 'col'=>$colName]));
        $icon = "-down";
    }elseif($currSort == 'desc' && $currCol == $colName){
        $action = url(add_query_params(['sort'=> 'asc', 'col'=>$colName]));
        $icon = "-up";
    }
    
    return view('components.table-sort', [
        'action' => $action,
        'icon' => $icon,
        'title' => $colTitle,
    ])->render();
}