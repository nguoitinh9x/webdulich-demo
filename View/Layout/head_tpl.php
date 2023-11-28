<meta charset="UTF-8">
<base href="<?=_BASEURL_?>">
<title><?php if($title_bar!='') echo $title_bar.' - '.$Setting['name_'.$lang]; else echo $Setting['title']; ?></title>
<link rel="icon" type="image/png" href="<?=_BASEURL_._upload_hinhanh_l.'64x64x2/'.$Favicon['photo']?>">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="<?=  $_SESSION['crsf_inc'] ?>">
<meta name="description" content="<?php if($description_bar!='') echo $description_bar; else echo $Setting['description']; ?>">
<meta name="keywords" content="<?php if($keywords_bar!='') echo $keywords_bar; else echo $Setting['keywords']; ?>">
<!-- DNS Prefetch -->
<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="//www.google-analytics.com" />
<link rel="dns-prefetch" href="//www.facebook.com" />
<link rel="dns-prefetch" href="//fonts.googleapis.com" />
<link rel="dns-prefetch" href="//sp.zalo.me" />
<link rel="dns-prefetch" href="//google.com" />
<link rel="dns-prefetch" href="//unpkg.com" />
<link href="//www.google-analytics.com" rel="dns-prefetch" />
<link href="//www.googletagmanager.com/" rel="dns-prefetch" />
<?php if($config['setup']['responsive']=='true'){?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php } else { ?>
	<meta name="viewport" content="width=1200" />
<?php } ?>
<meta name="robots" content="<?php if($meta_index!=''){ echo $meta_index;} else { echo "noodp,index,follow";} ?>" />
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<meta name='revisit-after' content='1 days' />
<meta name="ICBM" content="<?= $Setting['toado'] ?>">
<meta name="geo.position" content="<?= $Setting['toado'] ?>">
<meta name="geo.placename" content="<?= $Setting["address_$lang"] ?>">
<meta name="author" content="<?= $Setting["name_$lang"] ?>">
<link rel="publisher" href="<?= $Setting['googleplus'] ?>" />
<link rel="author" href="<?= $Setting['googleplus'] ?>" />
<link rel="canonical" href="<?= $func->canonical($template) ?>" />
<meta property="fb:pages" content="1436045866704479" />
<meta property="og:app_id" content="<?= $Setting['idfacebook'] ?>" />
<?php if(isset($share_facebook) && $share_facebook){ echo $share_facebook; } else { ?>
<meta property="og:site_name" content="<?= $Setting['website'] ?>" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:title" content="<?= $Setting['title'] ?>" />
<meta property="og:description" content="<?= $Setting['description'] ?>" />
<meta property="og:url" content="<?= _BASEURL_ ?>" />
<meta property="og:image" content="<?= _BASEURL_._upload_hinhanh_l.'500x500x2/'.$Logosite['photo'] ?>" />
<?php } ?>
<meta name="twitter:card" value="summary">
<meta name="twitter:url" content="<?= $get_nows ?>">
<meta name="twitter:title" content="<?php if($title_bar!='') echo $title_bar; else echo $Setting['title']; ?>">
<meta name="twitter:description" content="<?php if($description_bar!='') echo $description_bar; else echo $Setting['description']; ?>">
<meta name="twitter:image" content="<?= _BASEURL_._upload_hinhanh_l.'500x500x2/'.$Logosite['photo'] ?>"/>
<meta name="twitter:site" content="@">
<meta name="twitter:creator" content="@">
<meta name="dc.language" CONTENT="vietnamese">
<meta name="dc.source" CONTENT="<?= _BASEURL_ ?>">
<meta name="dc.title" CONTENT="<?php if($title_bar!='') echo $title_bar; else echo $Setting['title']; ?>">
<meta name="dc.keywords" CONTENT="<?php if($keywords_bar!='') echo $keywords_bar; else echo $Setting['keywords']; ?>">
<meta name="dc.description" CONTENT="<?php if($description_bar!='') echo $description_bar; else echo $Setting['description']; ?>">
<meta name="dc.publisher" content="<?= $Setting['googleplus'] ?>" />
<?= $Setting['codehead'] ?>
<link rel="stylesheet" href="Assets/typography.css"/>
<style type="text/css"><?= $plugin_css ?></style>
<link rel="stylesheet" href="Assets/css/template.css"/>
<?= $json->SearchAction(_SITEURL_) ?>
<?= $json->Organization() ?>
<?= $json->Person() ?>
<?= $json->Library() ?>
<?= empty($json_code) ? '' : $json_code ?>