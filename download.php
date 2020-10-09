<?php
	//get indexhtml content
 	$htmlContent = file_get_contents($_FILES["indexFile"]["tmp_name"]);
 	$url = $_POST['out_url'];
 	$xmlContent = '';
 	$folderName = date('Y_m_d_H_i_s');
 	if (!is_dir('new/'.$folderName)) {
	  mkdir('new/'.$folderName);
	}
 	$xmlTemp = file_get_contents('xml/sitemaptemp.xml');
 	if (strpos($htmlContent, '|||') !== false && strpos($htmlContent, '§§§') !== false && strpos($htmlContent, '€€€') !== false) {

	    //get article file content
	    $total = count($_FILES['articleFile']['name']);

	    for( $i=0 ; $i < $total ; $i++ ) {

			$articleContent = file_get_contents($_FILES["articleFile"]["tmp_name"][$i]);
		 	$fileName = $_FILES["articleFile"]["name"][$i];
		 	$fileNameHtml = str_replace(".html", '', $fileName);
		 	$saveFileName = str_replace(' ', '_', $_FILES["articleFile"]["name"][$i]);
		 	//get image and save in server
		 	$targetFile = "assets/img/".$_FILES["imageFile"]["name"];
		 	move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile);

		 	//Replace the title
		 	$htmlContentEdit = str_replace("|||", $fileNameHtml, $htmlContent);
		 	//Replace the image path
		 	$htmlContentEdit = str_replace("§§§", $_FILES["imageFile"]["name"], $htmlContentEdit);
		 	//Replace the text_scrib
			$htmlContentEdit = str_replace("€€€", $articleContent, $htmlContentEdit);
			$newFilePath = 'new/'.$folderName.'/'.$saveFileName;
			file_put_contents($newFilePath, $htmlContentEdit);
			$xmlContent .= '<url><loc> '.$url.'/'.$fileName.' </loc></url>' . PHP_EOL;
	    }
	    $xml = str_replace('xmlcontent', $xmlContent, $xmlTemp);
	    file_put_contents('new/'.$folderName.'/sitemap.xml', $xml);

	    //make the zip file
	    $pathdir = 'new/'.$folderName.'/';  
		// Enter the name to creating zipped directory 
		$zipcreated = 'new/'.$folderName.'/'.$folderName.'.zip';
		// Create new zip class 
		$zip = new ZipArchive;
		if($zip -> open($zipcreated, ZipArchive::CREATE ) === true) {
		    // Store the path into the variable 
		    $dir = opendir($pathdir);
		    while($file = readdir($dir)) {
		        if(is_file($pathdir.$file)) {
		            $zip -> addFile($pathdir.$file, $file);
		        }
		    }
		    $zip ->close();
		}
		echo $folderName; exit();
	}
	else {
		$return = ['result' => 'false', 'message' => 'Please check the index file'];
		echo json_encode($return); exit();
	}
 	
?>