<?php
require_once 'Url.php';

class Videos
{
	private function webms()
	{
		$path = realpath(__DIR__) . '/../webms';

		if(file_exists($path))
		{
            return glob($path . '/*.webm', GLOB_BRACE);
		}
		
		return false;
	}

	private function cache_exists()
	{
		return (isset($_SESSION['videos']) && isset($_SESSION['file_count']));
	}

	private function update_cache()
	{
		return (count($this->webms()) != $_SESSION['file_count']);
	}

	public function cache()
	{
		if(!$this->cache_exists() || ($this->update_cache()))
		{
			$_SESSION['videos'] = [];
			
			$files = $this->webms();
			
			$_SESSION['file_count'] = count($files);

			if(count($files))
			{
				foreach($files as $file)
				{
					$videoId = explode('/', $file);
					$videoId = end($videoId);
					$videoId = explode('.', $videoId)[0];

					$_SESSION['videos'][] = $videoId;
				}
			}
		}
	}

	public function random()
	{
		if(count($_SESSION['videos']))
		{
			return $_SESSION['videos'][array_rand($_SESSION['videos'])];
		}

		return false;
	}

	public function get($videoId = null)
	{
		if(!is_null($videoId))
		{
			if(ctype_alnum($videoId))
			{
				if(in_array($videoId, $_SESSION['videos']))
				{
					return Url() . '/webms/' . $videoId . '.webm';
				}
			}
		}

		return false;
	}
}