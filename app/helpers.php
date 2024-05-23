<?php

@ob_start();
session_start();

 function base_url()
{
	# code...
	return env('BASE_URL',url('/') );
}
function storage_url()
{
	# code...
	return url('/').'/storage/app';
}
function cdn_url()
{
	# code...
	return env('CDN_URL',url('/') );
}
function admin_url()
{
	# code...
	return url('/admin');
}

function str_slug_u($value='')
{
	# code...
	return str_replace(" ","_",$value);
}

if (! function_exists('escape_like')) {
    /**
     * @param $string
     * @return mixed
     */
    function escape_like($string)
    {
       /* $search = array('%', '_');
        $replace   = array('\%', '\_');
        return str_replace($search, $replace, $string);*/

        return strtolower(preg_replace("/[^a-zA-Z]+/", "", $search));
    }
}


?>  