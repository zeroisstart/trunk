<div class='floatright'>
	<?php echo CHtml::link(Yii::t('admincustompages', 'Add Page'), array('custompages/addpage'), array( 'class' => 'button' )); ?>
</div>

<div class="content-box"><!-- Start Content Box -->
	
	<div class="content-box-header">
		<h3><?php echo Yii::t('admincustompages', 'Custom Pages'); ?> (<?php echo Yii::app()->format->number($count); ?>)</h3>
	</div> <!-- End .content-box-header -->
	
	<div class="content-box-content">
			<?php echo CHtml::form(); ?>
			<table>
				<thead>
					<tr>
					   <th style='width: 5%;'><input class="check-all" type="checkbox" /></th>
					   <th style='width: 20%;'><?php echo $sort->link('title', Yii::t('admincustompages', 'Title'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by title') ) ); ?></th>
					<th style='width: 20%;'><?php echo $sort->link('alias', Yii::t('admincustompages', 'Alias'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by alias') ) ); ?></th>
					<th style='width: 15%;'><?php echo $sort->link('dateposted', Yii::t('admincustompages', 'Posted'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by date posted') ) ); ?></th>
					<th style='width: 10%;'><?php echo $sort->link('author', Yii::t('admincustompages', 'Author'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by author') ) ); ?></th>
					<th style='width: 10%;'><?php echo $sort->link('language', Yii::t('admincustompages', 'Language'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by language') ) ); ?></th>
					<th style='width: 5%;'><?php echo $sort->link('status', Yii::t('admincustompages', 'Status'), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Sort list by status') ) ); ?></th>
					   <th style='width: 10%;'><?php echo Yii::t('adminglobal', 'Options'); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="8">	
							<div class="bulk-actions align-left">
								<select name="bulkoperations">
									<option value=""><?php echo Yii::t('global', '-- Choose Action --'); ?></option>
									<option value="bulkdelete"><?php echo Yii::t('global', 'Delete Selected'); ?></option>
									<option value="bulkapprove"><?php echo Yii::t('global', 'Approve Selected'); ?></option>
									<option value="bulkunapprove"><?php echo Yii::t('global', 'UnApprove Selected'); ?></option>
								</select>
								<?php echo CHtml::submitButton( Yii::t('global', 'Apply'), array( 'confirm' => Yii::t('adminglobal', 'Are you sure you would like to perform a bulk operation?'), 'class'=>'button')); ?>
							</div>
													
							<?php $this->widget('widgets.admin.pager', array( 'pages' => $pages )); ?>
							<div class="clear"></div>
						</td>
					</tr>
				</tfoot>
				<tbody>
				<?php if ( count($rows) ): ?>
					
					<?php foreach ($rows as $row): ?>
						<tr>
							<td><?php echo CHtml::checkbox( 'record[' . $row->id.']' ); ?></td>
							<td><?php echo CHtml::encode($row->title); ?></td>
							<td><?php echo CHtml::encode($row->alias); ?></td>
							<td>
								<?php echo Yii::app()->dateFormatter->formatDateTime($row->dateposted, 'short', 'short'); ?>
								<?php if( $row->last_edited_date ): ?>
									<br /><small><span class='tooltip' title='<?php echo Yii::t('admincustompages', 'Last Modified Date'); ?>'><?php echo Yii::app()->dateFormatter->formatDateTime($row->last_edited_date, 'short', 'short'); ?></span></small>
								<?php endif; ?>	
							</td>
							<td>
								<?php echo $row->author ? CHtml::encode($row->author->username) : Yii::t('adminglobal', 'Unknown'); ?>
								<?php if( $row->last_edited_author ): ?>
									<br /><small><span class='tooltip' title='<?php echo Yii::t('admincustompages', 'Last Modified By'); ?>'><?php echo $row->lastauthor ? CHtml::encode($row->lastauthor->username) : Yii::t('adminglobal', 'Unknown'); ?></span></small>
								<?php endif; ?>
							</td>
							<td>
							<?php if( $row->language ): ?>
								<?php foreach(explode(',', $row->language) as $lang): ?>
									<?php echo Yii::app()->params['languages'][ $lang ]; ?>
								<?php endforeach; ?>	
							<?php else: ?>
							<?php echo Yii::t('adminglobal', 'All'); ?>
							<?php endif; ?>
							</td>
							<td>
								<?php echo CHtml::link( CHtml::image( Yii::app()->themeManager->baseUrl . '/images/icons/'. ($row->status ? 'tick_circle' : 'cross') . '.png' ), array('custompages/togglestatus', 'id' => $row->id), array( 'class' => 'tooltip', 'title' => Yii::t('admincustompages', 'Toggle page status!') ) ); ?>
							</td>
							<td>
								<!-- Icons -->
								 <a href="<?php echo Yii::app()->createAbsoluteUrl('/' . $row->alias, array('lang'=>$row->language) ); ?>" title="<?php echo Yii::t('admincustompages', 'view this page'); ?>" target='_blank' class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/preview.png" alt="Preview" /></a>
								 <a href="<?php echo $this->createUrl('custompages/editpage', array( 'id' => $row->id )); ?>" title="<?php echo Yii::t('admincustompages', 'Edit this page'); ?>" class='tooltip'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/pencil.png" alt="Edit" /></a>
								 <a href="<?php echo $this->createUrl('custompages/deletepage', array( 'id' => $row->id )); ?>" title="<?php echo Yii::t('admincustompages', 'Delete this page!'); ?> "class='tooltip deletelink'><img src="<?php echo Yii::app()->themeManager->baseUrl; ?>/images/icons/cross.png" alt="Delete" /></a>
							</td>
						</tr>
					<?php endforeach ?>
					
				<?php else: ?>	
					<tr>
						<td colspan='8' style='text-align:center;'><?php echo Yii::t('adminglobal', 'No Rows Found.'); ?></td>
					</tr>
				<?php endif; ?>
				</tbody>
			</table>
		<?php echo CHtml::endForm(); ?>
	</div> <!-- End .content-box-content -->
	
</div> <!-- End .content-box -->
