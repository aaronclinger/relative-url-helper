<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function relative_to_absolute_url($host, $path)
{
	$host_parts    = parse_url($host);
	$path_parts    = parse_url($path);
	$absolute_path = '';
	
	if (isset($path_parts['path']) && isset($host_parts['scheme']) && substr($path_parts['path'], 0, 2) === '//' && ! isset($path_parts['scheme']))
	{
		$path       = $host_parts['scheme'] . ':' . $path;
		$path_parts = parse_url($path);
	}
	
	if (isset($path_parts['host']))
	{
		return $path;
	}
	
	if (isset($host_parts['scheme']))
	{
		$absolute_path .= $host_parts['scheme'] . '://';
	}
	
	if (isset($host_parts['user']))
	{
		if (isset($host_parts['pass']))
		{
			$absolute_path .= $host_parts['user'] . ':' . $host_parts['pass'] . '@';
		}
		else
		{
			$absolute_path .= $host_parts['user'] . '@';
		}
	}
	
	if (isset($host_parts['host']))
	{
		$absolute_path .= $host_parts['host'];
	}
	
	if (isset($host_parts['port']))
	{
		$absolute_path .= ':' . $host_parts['port'];
	}
	
	if (isset($path_parts['path']))
	{
		$path_segments = explode('/', $path_parts['path']);
		
		if (isset($host_parts['path']))
		{
			$host_segments = explode('/', $host_parts['path']);
		}
		else
		{
			$host_segments = array('', '');
		}
		
		$i = -1;
		while (++$i < count($path_segments))
		{
			$path_seg  = $path_segments[$i];
			$last_item = end($host_segments);
			
			switch ($path_seg)
			{
				case '.' :
					if ($i === 0 || empty($last_item))
					{
						array_splice($host_segments, -1);
					}
					break;
				case '..' :
					if ($i === 0 && ! empty($last_item))
					{
						array_splice($host_segments, -2);
					}
					else
					{
						array_splice($host_segments, empty($last_item) ? -2 : -1);
					}
					break;
				case '' :
					if ($i === 0)
					{
						$host_segments = array();
					}
					else
					{
						$host_segments[] = $path_seg;
					}
					break;
				default :
					if ($i === 0 && ! empty($last_item))
					{
						array_splice($host_segments, -1);
					}
					
					$host_segments[] = $path_seg;
					break;
			}
		}
		
		$absolute_path .= '/' . ltrim(implode('/', $host_segments), '/');
	}
	
	if (isset($path_parts['query']))
	{
		$absolute_path .= '?' . $path_parts['query'];
	}
	
	if (isset($path_parts['fragment']))
	{
		$absolute_path .= '#' . $path_parts['fragment'];
	}
	
	return $absolute_path;
}

/* End of file relative_url_helper.php */
/* Location: ./application/helpers/relative_url_helper.php */
