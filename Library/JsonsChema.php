<?php 
namespace Library;
/**
	 * Application Main Page That Will Serve All Requests
	 *
	 * @package PRO CODE CIP Framework
	 * @author  code@cipmedia.vn
	 * @version 1.0.0
	 * @license http://cipmedia.vn
	 */
class JsonsChema {

	public function __construct($db,$func)
    {  
    	$this->db = $db;
    	$this->func = $func;
    }

	public function ItemList($com,$item){
		global $config;
		if(count($item)>5){
			$dem = 5;
		} else {
			$dem = count($item);
		}
		$html = '<script type="application/ld+json">
		{
		  "@context":"http://schema.org",
		  "@type":"ItemList",
		  "itemListElement":[';
		  	for($i=1;$i<$dem;$i++){
			    $html .= '{
			      "@type":"ListItem",
			      "position":'.$i.',
			      "url":"'._BASEURL_.$com.'/'.$item[$i]['slug'].'.html"
			    },';
			}
				$html .= '{
			      "@type":"ListItem",
			      "position":'.$dem.',
			      "url":"'._BASEURL_.$com.'/'.$item[0]['slug'].'.html"
			    }';
		$html .= ']
		}
		</script>';
		return self::compress($html);
	}

	public function BreadcrumbList($data,$tbl,$com,$type,$title,$cate=0){
		global $config,$db,$lang;
		$k=1;
		$bread_kq .= '{
		   "@type": "ListItem",
		   "position": '.$k.',
		   "item":
		   {
		    "@id": "'._BASEURL_.'",
		    "name": "Home"
		    }
		  },';
		$k++;
		$bread_kq .= '{
		   "@type": "ListItem",
		   "position": '.$k.',
		   "item":
		   {
		    "@id": "'._BASEURL_.$com.'.html",
		    "name": "'.$title.'"
		    }
		  },';
		if($cate>=1){
			$k++;
			$row_detail1 = $db->row("select * from #_cate_list where id='".$data['id_list']."' and type='".$type."' ");
			$bread_kq .= '{
			   "@type": "ListItem",
			   "position": '.$k.',
			   "item":
			   {
			    "@id": "'._BASEURL_.$com.'/'.$row_detail1['slug'].'",
			    "name": "'.$row_detail1['name_'.$lang].'"
			    }
			},';
		}
		if($cate>=2){
			$k++;

			$row_detail2 = $db->row("select * from #_cate_cat where id='".$data['id_cat']."' and type='".$type."' ");
			$bread_kq .= '{
			   "@type": "ListItem",
			   "position": '.$k.',
			   "item":
			   {
			    "@id": "'._BASEURL_.$com.'/'.$row_detail1['slug'].'/'.$row_detail2['slug'].'",
			    "name": "'.$row_detail2['name_'.$lang].'"
			    }
			},';
		}
		$k++;
		$bread_kq .= '{
		   "@type": "ListItem",
		   "position": '.$k.',
		   "item":
		   {
		    "@id": "'._BASEURL_.$com.'/'.$data['slug'].'.html",
		    "name": "'.$data['name_vi'].'"
		    }
		  },';

		$html = '<script type="application/ld+json">
		{
		 "@context": "http://schema.org",
		 "@type": "BreadcrumbList",
		 "itemListElement":
		 ['.trim($bread_kq,',').']
		}
		</script>';
		return self::compress($html);
	}


	public function Library(){
		global $config,$favicon,$Setting;
		$map = explode(',',$Setting['location_map']);
		$html = '<script type="application/ld+json">{
		"@context": "http://schema.org/",
		  	"@type": "Library",
			"url": "'._BASEURL_.'",
			"name": "'.$Setting['description'].'",
			"image": "'._BASEURL_._upload_hinhanh_l.$favicon['photo_vi'].'",
			"priceRange":"FREE",
			"hasMap": "'.isset($Setting['hasmap']) ? '' : $Setting['hasmap'].'",	
			"email": "mailto:'.$Setting['email'].'",
		  	"address": {
		    	"@type": "PostalAddress",
		    	"addressLocality": "'.(isset($Setting['quan']) ? $Setting['quan'] : '').'",
		    	"addressRegion": "'.(isset($Setting['tinh']) ? $Setting['tinh'] : '').'",
		    	"postalCode":"'.(isset($Setting['postalcode']) ? $Setting['postalcode'] : '').'",
		    	"streetAddress": "'.(isset($Setting['address']) ? $Setting['address'] : '').'"
		  	},
		  	"description": "'.$Setting['description'].'",
		  	"telephone": "+84 '.$Setting['phone'].'",
		  	"geo": {
		    	"@type": "GeoCoordinates",
		   		"latitude": "'.trim($map[0]).'",
		    	"longitude": "'.trim($map[1]).'"
		 		}, 			
		  	"sameAs" : [ "'.$Setting['facebook'].'","'.$Setting['googleplus'].'"]
			}</script>';
		return self::compress($html);
	}

	public function SearchAction(){
		global $config,$favicon,$Setting;
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Website",
		  "url": "'._BASEURL_.'",
		  "potentialAction": [{
		    "@type": "SearchAction",
		    "target": "'._BASEURL_.'tim-kiem.html&keywords={searchbox_target}",
		    "query-input": "required name=searchbox_target"
		  }]
		}
		</script>';
		return self::compress($html);
	}

	public function Person(){
		global $config,$Setting,$lang;
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Person",
		  "name": "'.$Setting['shortname_'.$lang].'",
		  "url": "'._BASEURL_.'",
		  "sameAs": [
		    "'.$Setting['facebook'].'",
		    "'.$Setting['googleplus'].'"
		  ]
		}
		</script>';
		return self::compress($html);
	}

	public function NewsArticle($data){
		global $config,$lang,$Setting,$favicon;
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "NewsArticle",
		  "mainEntityOfPage": {
		    "@type": "WebPage",
		    "@id": "'.$this->func->getCurrentPageURL().'"
		  },
		  "headline": "'.$data['name_'.$lang].'",
		  "image": ["'._BASEURL_._upload_post_l.$data['photo'].'"
		   ],
		  "datePublished": "'.date('c',strtotime($data['datecreate'])).'",
		  "dateModified": "'.date('c',strtotime($data['dateupdate'])).'",
		  "author": {
		    "@type": "Person",
		    "name": "Administrator"
		  },
		  "aggregateRating": {
		    "@type": "AggregateRating",
		    "ratingValue": "5.0",
		    "reviewCount": "1"
		  },
		   "publisher": {
		    "@type": "Organization",
		    "name": "'.$Setting['name_'.$lang].'",
		    "logo": {
		      "@type": "ImageObject",
		      "url": "'._BASEURL_._upload_hinhanh_l.$favicon['photo_vi'].'"
		    }
		  },
		  "description": "'.$data['description_'.$lang].'"
		}
		</script>';
		return self::compress($html);
	}

	public function VideoObject(){
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "VideoObject",
		  "name": "Title",
		  "description": "Video description",
		  "thumbnailUrl": "https://www.example.com/thumbnail.jpg",
		  "uploadDate": "2015-02-05T08:00:00+08:00",
		  "duration": "PT1M33S",
		  "publisher": {
		    "@type": "Organization",
		    "name": "Example Publisher",
		    "logo": {
		      "@type": "ImageObject",
		      "url": "https://example.com/logo.jpg",
		      "width": 600,
		      "height": 60
		    }
		  },
		  "contentUrl": "https://www.example.com/video123.flv",
		  "embedUrl": "https://www.example.com/videoplayer.swf?video=123",
		  "interactionCount": "2347"
		}
		</script>';
		return self::compress($html);
	}

	public function JobPosting(){
		$html = '<script type="application/ld+json"> {
		  "@context" : "http://schema.org/",
		  "@type" : "JobPosting",
		  "title" : "Fitter and Turner",
		  "description" : "<p>Widget assembly role for pressing wheel assemblies.</p>
		    <p><strong>Educational Requirements:</strong> Completed level 2 ISTA
		    Machinist Apprenticeship.</p>
		    <p><strong>Required Experience:</strong> At
		    least 3 years in a machinist role.</p>",
		  "identifier": {
		    "@type": "PropertyValue",
		    "name": "MagsRUs Wheel Company",
		    "value": "1234567"
		  },
		  "datePosted" : "2017-01-18",
		  "validThrough" : "2017-03-18T00:00",
		  "employmentType" : "CONTRACTOR",
		  "hiringOrganization" : {
		    "@type" : "Organization",
		    "name" : "MagsRUs Wheel Company",
		    "sameAs" : "http://www.magsruswheelcompany.com",
		    "logo" : "http://www.example.com/images/logo.png"
		  },
		  "jobLocation" : {
		    "@type" : "Place",
		    "address" : {
		      "@type" : "PostalAddress",
		      "streetAddress" : "555 Clancy St",
		      "addressLocality" : "Detroit",
		      "addressRegion" : "MI",
		      "postalCode" : "48201",
		      "addressCountry": "US"
		    }
		  },
		  "baseSalary": {
		    "@type": "MonetaryAmount",
		    "currency": "USD",
		    "value": {
		      "@type": "QuantitativeValue",
		      "value": 40.00,
		      "unitText": "HOUR"
		    }
		  }
		}
		</script>';
		return self::compress($html);
	}

	public function Restaurant(){
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Restaurant",
		  "image": [
		    "https://example.com/photos/1x1/photo.jpg",
		    "https://example.com/photos/4x3/photo.jpg",
		    "https://example.com/photos/16x9/photo.jpg"
		   ],
		  "@id": "http://davessteakhouse.example.com",
		  "name": "Dave s Steak House",
		  "address": {
		    "@type": "PostalAddress",
		    "streetAddress": "148 W 51st St",
		    "addressLocality": "New York",
		    "addressRegion": "NY",
		    "postalCode": "10019",
		    "addressCountry": "US"
		  },
		  "geo": {
		    "@type": "GeoCoordinates",
		    "latitude": 40.761293,
		    "longitude": -73.982294
		  },
		  "url": "http://www.example.com/restaurant-locations/manhattan",
		  "telephone": "+12122459600",
		  "openingHoursSpecification": [
		    {
		      "@type": "OpeningHoursSpecification",
		      "dayOfWeek": [
		        "Monday",
		        "Tuesday"
		      ],
		      "opens": "11:30",
		      "closes": "22:00"
		    },
		    {
		      "@type": "OpeningHoursSpecification",
		      "dayOfWeek": [
		        "Wednesday",
		        "Thursday",
		        "Friday"
		      ],
		      "opens": "11:30",
		      "closes": "23:00"
		    },
		    {
		      "@type": "OpeningHoursSpecification",
		      "dayOfWeek": "Saturday",
		      "opens": "16:00",
		      "closes": "23:00"
		    },
		    {
		      "@type": "OpeningHoursSpecification",
		      "dayOfWeek": "Sunday",
		      "opens": "16:00",
		      "closes": "22:00"
		    }
		  ],
		  "menu": "http://www.example.com/menu",
		  "acceptsReservations": "True"
		}
		</script>
		';
		return self::compress($html);
	}

	public function Review($row_detail,$row_star=1,$num_star=5){
		global $lang,$func,$Setting,$config;
		if(!$num_star){
			$num_star = 5;
		}
		if(!$row_star){
			$row_star = 1;
		}

		$html = '<script type="application/ld+json">
			{
			  "@context": "http://schema.org/",
			  "@type": "Product",
			  "image": "'._BASEURL_._upload_product_l.$row_detail['photo'].'",
			  "name": "'.$row_detail['name_'.$lang].'",
			  "review": {
			    "@type": "Review",
			    "reviewRating": {
			      "@type": "Rating",
			      "ratingValue": "'.$num_star.'"
			    },
			    "name": "'.$row_detail['name_'.$lang].'",
			    "author": {
			      "@type": "Person",
			      "name": "Administrator"
			    },
			    "datePublished": "'.date('c',strtotime($row_detail['datecreate'])).'",
			    "reviewBody": "'.$row_detail['description_'.$lang].'",
			    "publisher": {
			      "@type": "Organization",
			      "name": "'.$Setting['shortname_'.$lang].'"
			    }
			  }
			}
			</script>';
		return self::compress($html);
	} 

	public function Product($row_detail,$row_star=1,$num_star=5){
		global $lang,$func,$Setting,$config;
		if(!$num_star){
			$num_star = 5;
		}
		if(!$row_star){
			$row_star = 1;
		}

		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org/",
		  "@type": "Product",
		  "name": "'.$row_detail['name_'.$lang].'",
		  "image": [
		    "'._BASEURL_._upload_product_l.'/600x600x2/'.$row_detail['photo'].'",
		    "'._BASEURL_._upload_product_l.'/600x450x2/'.$row_detail['photo'].'",
		    "'._BASEURL_._upload_product_l.'/600x315x2/'.$row_detail['photo'].'"
		   ],
		  "description": "'.$row_detail['description_'.$lang].'",
		  "mpn": "'.$row_detail['code'].'",
		  "brand": {
		    "@type": "Thing",
		    "name": "'.$Setting['shortname_'.$lang].'"
		  },
		  "aggregateRating": {
		    "@type": "AggregateRating",
		    "ratingValue": "'.$num_star.'",
		    "reviewCount": "'.$row_star.'"
		  },
		  "offers": {
		    "@type": "Offer",
		    "priceCurrency": "VND",
		    "price": "'.$row_detail['price'].'",
		    "priceValidUntil": "'.date('c',strtotime('2020-12-30')).'",
		    "itemCondition": "http://schema.org/UsedCondition",
		    "availability": "http://schema.org/InStock",
		    "seller": {
		      "@type": "Organization",
		      "name": "'.$Setting['shortname_'.$lang].'"
		    }
		  }
		}
		</script>';
		return self::compress($html);
	}

	public function ShopProduct(){
		$html = '<script type="application/ld+json">
		{
		  "@context": "http://schema.org/",
		  "@type": "Product",
		  "name": "Executive Anvil",
		  "image": [
		    "https://example.com/photos/1x1/photo.jpg",
		    "https://example.com/photos/4x3/photo.jpg",
		    "https://example.com/photos/16x9/photo.jpg"
		   ],
		  "brand": {
		    "@type": "Thing",
		    "name": "ACME"
		  },
		  "aggregateRating": {
		    "@type": "AggregateRating",
		    "ratingValue": "4.4",
		    "ratingCount": "89"
		  },
		  "offers": {
		    "@type": "AggregateOffer",
		    "lowPrice": "119.99",
		    "highPrice": "199.99",
		    "priceCurrency": "USD"
		  }
		}
		</script>';
		return self::compress($html);
	}

	public function Organization(){
		global $config,$Setting,$favicon,$lang;
		$html = '
		<script type="application/ld+json">
		{ "@context" : "http://schema.org",
		  "@type" : "Organization",
		  "name":"'.$Setting['name_'.$lang].'",
		  "url" : "'.$this->func->getCurrentPageURL().'",
		  "logo":"'._BASEURL_._upload_hinhanh_l.$favicon['photo_vi'].'",
		  "contactPoint" : [
		    {
		      "@type" : "ContactPoint",
		      "telephone" : "+84 '.$Setting['phone'].'",
		      "contactType" : "Customer Service",
		      "contactOption" : "Support",
		      "areaServed" : ["VN"],
		      "availableLanguage" : ["Viet Nam"]
		    } 
		    ] }
		</script>';
		return self::compress($html);
	}

	public function Recipe($data){
		global $lang;
		$html = ' <script type="application/ld+json">
		{
		  "@context": "http://schema.org/",
		  "@type": "Recipe",
		  "name": "'.$data['name_'.$lang].'",
		  "author": "Admin",
		  "image": "'._BASEURL_._upload_product_l.$data['photo'].'",
		  "description": "'.$data['description_'.$lang].'",
		  "aggregateRating": {
		    "@type": "AggregateRating",
		    "ratingValue": "4.5",
		    "reviewCount": "6",
		    "bestRating": "5",
		    "worstRating": "3"
		  },
		  "prepTime": "PT30M",
		  "totalTime": "PT1H",
		  "recipeYield": "8",
		  "nutrition": {
		    "@type": "NutritionInformation",
		    "servingSize": "1 medium slice",
		    "calories": "230 calories",
		    "fatContent": "1 g",
		    "carbohydrateContent": "43 g",
		  },
		  "recipeIngredient": [
		    "1 box refrigerated pie crusts, softened as directed on box",
		    "6 cups thinly sliced, peeled apples (6 medium)",
		    "..."
		  ],
		  "recipeInstructions": [
		    "1...",
		    "2..."
		   ]
		}
		</script>';
	
	return self::compress($html);
	}

	static public function compress($buffer){
    	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(': ', ':', $buffer);
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		return $buffer;
    }

}
?>