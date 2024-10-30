<?php


function mospt_is_curl_installed()
{
    if  (in_array  ('curl', get_loaded_extensions()))
        return 1;
    else
        return 0;
}