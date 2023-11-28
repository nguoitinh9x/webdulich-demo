<div class="container clearfix">
	<?=$breadcrumbs->urls($row_detail)?> 

	<div class="title-style-1"><h1><?=_giohang?></h1></div>
	<div class="w-100 clearfix">
		<form name="form" method="post" class="frm-cart">
			<input type="hidden" name="pid"/>
			<input type="hidden" name="command"/>
			<table cellpadding="5" class="w-100 text-center mb-4 clearfix">
				<tr class="menu_giohang">
					<td><?=_stt?></td>
					<td><?=_sanpham?></td>
					<td><?=_soluong?></td>
					<td><?=_tonggia?></td>
					<td><?=_xoa?></td>
				</tr>
				<?php if(is_array($_SESSION['cart'])){
					$max=count($_SESSION['cart']);
					for($i=0;$i<$max;$i++):
						$pid = $_SESSION['cart'][$i]['productid'];
						$q = $_SESSION['cart'][$i]['qty'];
						$pinfo = $cart->get_product_info($pid);
						if($q==0) continue;
						?>
						<tr class="form_giohang" data-id="<?=$pid?>">
							<td><?=$i+1?></td>
							<td class="grp-img-cart">
								<div class="img">
									<img src="Upload/product/<?=$pinfo['thumb']?>"/>
								</div>
								<div class="details">
									<h3><a href="san-pham/<?=$pinfo['slug']?>" target="_blank"><?=$pinfo['name_'.$lang]?></a></h3>
									<p><span><?=_gia?> :</span> <?=number_format($pinfo['price'],0, ',', '.')?> đ</p>
								</div>
							</td>
							<td><input name="soluong" value="<?=$q?>" class="capnhat_sl"/></td>                    
							<td class="res_cart capnhat_price"><?=number_format($pinfo['price']*$q,0, ',', '.')?> đ</td>
							<td><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAYFBMVEUAAAD1mCntHyTtHyT1mCn1mCn1mCntHyTtHyTtHyT1mCntHyT1mCn1mCntHyT1mCn1mCntHyTtHyT1mCntHyTtHyTtHyT1mCntHyT1mCn1mCntHyTtHyT1mCn1mCntHySksVMUAAAAHnRSTlMAvxDPQBDPYO8wgL/vMIBQICBA399wn6+PcGBQr5+7yhRHAAADIElEQVR42u3byY7iQBCE4fQKeAHM1kwzlN//LWc0MgSaFITd6VRdHOcS/9dsog8lr8urr2TsdvJcd67rrL4eZOTSv+dP9eX/8/uqCePXFM+Hu/bD6m5Uf/s8vxGsqMKkVc9+1j+33vB8Wr+cv8ljbRmmrZVheDwmgFef3zUT+0cZtuoxIkAfq4d+mLq7DDv1WsD72OHf899MzOMtsOkxCGgfu4hIUYbJ2+EVIALV169BFaYvx0eKC9DXO4nsA3b8LmT0AOAC9PUzUKH/S6bu0BOB6mtAoz7bE5b2RED6/Vly8veTXYiA9NcpXoFSfrJuTQXo621Fvh6Ab/nRVv0HAevXIpI8AIXMLaD9LH0FiDgIeF8e/UQcBKzPAHYB6VOAXUD6DGAXkD4D2AWsrwH+AvQ1wF+Avgb4C9D3AEDA+x4ACHjfAwAB73sAIOB9FwAEtO8KgID3NcBTgL4/QM6k7w1Is578QnEFoM8FHGDvcwEArn0IvADoM4EPAH0u8AGgzwU+APS5gACc+xBwgL3PBQC49LkAAJc+FwDg0s/OTACASz+l/zsD4NMXJgDAp08FALj0uQAAjz4X2AG/P/S5oDMDbqRPBLUZcCJ9JjgYARvSp4KrEbAifXq0NgK2rL8ngswKIP17034W1EbA7XM/D4EIrID0TR8AIjgDYP8eQh8AJuisgE71FeCT4Gr/Kl6pvgK8F2SiACbBBX0AlGCNd2BqAGDd8D443UQUYFglWHcZzq/m+0l22G5XGxEK0OftAIwA1BbAAlgAC2ABLIAFsAAWwFyAtkrervQH7JNA5gtomxAPgD7fzgdQHMPI7X0A1dh+JT6AsU9AIj6A/ch+WTgBclPfH4B+HAD6cQDoxwGgHweAfhwA+nEA6McBoB8HgH4cAPpxAOjHAaAfB4B+HAD6MQHo+wPsfQBKA8DSlzIMMwAMfdMFh3yGvumKR27p69/2RwPA0Ldc88nn6FsuOuVz9C1XvfI5+pbLbrm9j6cAK5OxK019rCiDYbzP1zZx+tguVh+CJk4fa8s4fayoovT55Xe+u62vr/9Pyyc7Y/MPnpqIGgsUEi4AAAAASUVORK5CYII=" class="xoa_cart"/></td>
						</tr>
					<?php endfor ?>
					<tr class="tonggia">
						<td colspan="5"><?=_tonggia?>: <b class="capnhat_full"><?=number_format($cart->get_order_total(),0, ',', '.')?> đ</b></td>
					</tr>
				<?php }	else{echo '<div class="alert alert-danger w-100 clearfix">'._bankhongcosanphamnaotronggiohang.' !</div>';}?>
			</table>
			<div class="grp-button-cart clearfix">
				<input type="button" value="<?=_muatiep?>" onclick="window.location='./'" class="g_muatiep">
				<input type="button" value="<?=_xoatatca?>" class="g_muatiep delete_all">
				<input type="button" value="<?=_thanhtoan?>" onclick="window.location='thanh-toan/'" class="g_muatiep">
			</div>
		</form>
	</div>
</div>