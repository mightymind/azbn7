<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Редактирование параметра</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/sysopt/');?>" method="POST" >
	
	<input type="hidden" name="item[id]" value="<?=$param['item']['id'];?>" />
	
	<div class="form-group">
		<label >Идентификатор параметра</label>
		<input type="text" class="form-control" value="<?=$param['item']['uid'];?>" disabled >
		<small class="form-text text-muted">Изменить значение нельзя</small>
	</div>
	
	<div class="form-group">
		<label >Название (пояснение)</label>
		<input type="text" class="form-control" name="item[data][title]" value="<?=$param['item']['title'];?>" >
	</div>
	
	<div class="form-group">
		<label >Формат</label>
		<select class="form-control" name="item[json]" data-select-value="<?=$param['item']['json'];?>" >
			<option value="0" >любой</option>
			<option value="1" >JSON</option>
		</select>
	</div>
	
	<div class="form-group">
		<label >Возможность редактирования</label>
		<select class="form-control" name="item[editable]" data-select-value="<?=$param['item']['editable'];?>" >
			<option value="0" >нет, параметр нельзя редактировать</option>
			<option value="1" >да, параметр можно редактировать</option>
		</select>
	</div>
	
	<div class="form-group">
		<label >Значение параметра</label>
		<textarea class="form-control" name="item[value]" rows="3"><?=$param['item']['value'];?></textarea>
	</div>
	
	<!--
	<div class="form-check">
		<label class="form-check-label">
			<input type="checkbox" class="form-check-input">
			Check me out
		</label>
	</div>
	-->
	
	<button type="submit" class="btn btn-primary">Обновить</button>
	
</form>