<?php
/* @var $this yii\web\View */

$this->title = 'Sayygo API';
\backend\assets\DashboardAsset::register($this);
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">

			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-clock-o fa-fw"></i> Timeline
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<ul class="timeline">
						<li>
							<div class="timeline-badge"><i class="fa fa-check"></i>
							</div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>

									<p>
										<small class="text-muted"><i class="fa fa-time"></i> 11 hours ago via
											Twitter
										</small>
									</p>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
						<li class="timeline-inverted">
							<div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
							</div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>

									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-badge danger"><i class="fa fa-credit-card"></i>
							</div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
						<li class="timeline-inverted">
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-badge info"><i class="fa fa-save"></i>
							</div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
									<hr>
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle"
										        data-toggle="dropdown">
											<i class="fa fa-cog"></i>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Action</a>
											</li>
											<li><a href="#">Another action</a>
											</li>
											<li><a href="#">Something else here</a>
											</li>
											<li class="divider"></li>
											<li><a href="#">Separated link</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
						<li class="timeline-inverted">
							<div class="timeline-badge success"><i class="fa fa-thumbs-up"></i>
							</div>
							<div class="timeline-panel">
								<div class="timeline-heading">
									<h4 class="timeline-title">Timeline Event</h4>
								</div>
								<div class="timeline-body">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel justo eu
										mi scelerisque vulputate. Aliquam in metus eu lectus aliquet egestas.</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->