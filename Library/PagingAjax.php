<?php
	namespace Library;
	class PagingAjax
	{
	    public $data; // DATA
	    public $per_page = 5; // SỐ RECORD TRÊN 1 TRANG
	    public $page; // SỐ PAGE 
	    public $text_sql; // CÂU TRUY VẤN
	    //	THÔNG SỐ SHOW HAY HIDE 
	    public $show_pagination = true;
	    public $show_goto = false;
	    public $show_total = true;
	    // TÊN CÁC CLASS
	    public $class_pagination; 
	    public $class_active;
	    public $class_inactive;
	    public $class_go_button;
	    public $class_text_total;
	    public $class_txt_goto;
	    private $cur_page;	// PAGE HIỆN TẠI
	    public $num_row; // SỐ RECORD
	    // PHƯƠNG THỨC LẤY KẾT QUẢ CỦA TRANG 
	    public function GetResult()
	    {
	    	global $db;
	        // TÌNH TOÁN THÔNG SỐ LẤY KẾT QUẢ
	        $this->cur_page = $this->page;
	        $this->page -= 1;
	        $this->per_page = $this->per_page;
	        $start = $this->page * $this->per_page;
	        // TÍNH TỔNG RECORD TRONG BẢNG
			$result = $db->query($this->text_sql);
	        $this->num_row = count($result);
	        // LẤY KẾT QUẢ TRANG HIỆN TẠI
	        return $db->query($this->text_sql." LIMIT $start, $this->per_page");
	    }
	    
	    // PHƯƠNG THỨC XỬ LÝ KẾT QUẢ VÀ HIỂN THỊ PHÂN TRANG
	    public function Load()
	    {
	        // KHÔNG PHÂN TRANG THÌ TRẢ KẾT QUẢ VỀ
	        if(!$this->show_pagination)
	            return $this->data;
	        // SHOW CÁC NÚT NEXT, PREVIOUS, FIRST & LAST
	        $previous_btn = true;
	        $next_btn = true;
	        $first_btn = true;
	        $last_btn = true;
	        // GÁN DATA CHO CHUỖI KẾT QUẢ TRẢ VỀ 
	        $msg = $this->data;
	        // TÍNH SỐ TRANG
	        $count = $this->num_row;
	        $no_of_paginations = ceil($count / $this->per_page);
	        // TÍNH TOÁN GIÁ TRỊ BẮT ĐẦU & KẾT THÚC VÒNG LẶP
	        if ($this->cur_page >= 5) {
	            $start_loop = $this->cur_page - 3;
	            if ($no_of_paginations > $this->cur_page + 3)
	                $end_loop = $this->cur_page + 3;
	            else if ($this->cur_page <= $no_of_paginations && $this->cur_page > $no_of_paginations - 5) {
	                $start_loop = $no_of_paginations - 5;
	                $end_loop = $no_of_paginations;
	            } else {
	                $end_loop = $no_of_paginations;
	            }
	        } else {
	            $start_loop = 1;
	            if ($no_of_paginations > 6)
	                $end_loop = 6;
	            else
	                $end_loop = $no_of_paginations;
	        }
	        // NỐI THÊM VÀO CHUỖI KẾT QUẢ & HIỂN THỊ NÚT FIRST 
	        $msg .= "<div class='$this->class_pagination'><ul>";
	        if ($first_btn && $this->cur_page > 1) {
	            $msg .= "<li p='1' class='active'><<</li>";
	        } else if ($first_btn) {
	            $msg .= "<li p='1' class='$this->class_inactive'><<</li>";
	        }
	        // HIỂN THỊ NÚT PREVIOUS
	        if ($previous_btn && $this->cur_page > 1) {
	            $pre = $this->cur_page - 1;
	            $msg .= "<li p='$pre' class='active'><</li>";
	        } else if ($previous_btn) {
	            $msg .= "<li class='$this->class_inactive'><</li>";
	        }
	        for ($i = $start_loop; $i <= $end_loop; $i++) {
	            if ($this->cur_page == $i)
	                $msg .= "<li p='$i' class='actived'><a>{$i}</a></li>";
	            else
	                $msg .= "<li p='$i' class='active'><a>{$i}</a></li>";
	        }
	        // HIỂN THỊ NÚT NEXT
	        if ($next_btn && $this->cur_page < $no_of_paginations) {
	            $nex = $this->cur_page + 1;
	            $msg .= "<li p='$nex' class='active'>></li>";
	        } else if ($next_btn) {
	            $msg .= "<li class='$this->class_inactive'>></li>";
	        }
	        // HIỂN THỊ NÚT LAST
	        if ($last_btn && $this->cur_page < $no_of_paginations) {
	            $msg .= "<li p='$no_of_paginations' class='$this->class_active'> >> </li>";
	        } else if ($last_btn) {
	            $msg .= "<li p='$no_of_paginations' class='$this->class_inactive'> >> </li>";
	        }
	        // SHOW TEXTBOX ĐỂ NHẬP PAGE KO ? 
	        if($this->show_goto)
				$goto = "<input type='text' id='goto' class='$this->class_txt_goto' size='1' style='margin-top:-1px;margin-left:40px;margin-right:10px'/><input type='button' id='go_btn' class='$this->class_go_button' value='Đến'/>";
	        if($this->show_total)
	            $total_string = "<span class='$this->class_text_total' a='$no_of_paginations'>Page <b>" . $this->cur_page . "</b>/<b>$no_of_paginations</b></span>";
	        $stradd =  $goto . $total_string;
	        // TRẢ KẾT QUẢ TRỞ VỀ
	        return $msg . "</ul>" . $stradd . "</div>";  // Content for pagination
	    }     
		            
	}
?>