<div id="main">
	<div class="section section-bg-10 pt-4 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page-title text-center">Nous Contacter</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="section border-bottom pt-2 pb-2">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumbs">
						<li><a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">Le Marché</a></li>
						<li>Contacts</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="section pt-10 pb-10">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="text-center mb-1 section-pretitle">Nos contacts</div>
					<!-- <h2 class="text-center section-title mtn-2">HEALTHY ORGANIC FARM</h2> -->
					<div class="organik-seperator mb-6 center">
						<span class="sep-holder"><span class="sep-line"></span></span>
						<div class="sep-icon"><i class="organik-flower"></i></div>
						<span class="sep-holder"><span class="sep-line"></span></span>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-sm-12">
					<div id="googleMap" class="mb-6" data-icon="images/icon_location.png" data-lat="37.789133" data-lon="-122.402158"></div>
				</div>
			</div> -->
			<div class="row">

				 <div class="col-sm-3">
					<div class="contact-info">
						<div class="contact-icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="contact-inner">
							<h6 class="contact-title"> Telephone I</h6>
							<div class="contact-content">
								0122 333 8889
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="contact-info">
						<div class="contact-icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="contact-inner">
							<h6 class="contact-title"> Telephone II</h6>
							<div class="contact-content">
								0122 333 8889
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="contact-info">
						<div class="contact-icon">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="contact-inner">
							<h6 class="contact-title"> Adresses Email </h6>
							<div class="contact-content">
								info@chocomarket.com
								<br />
								support@chocmarket.com
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="contact-info">
						<div class="contact-icon">
							<i class="fa fa-globe"></i>
						</div>
						<div class="contact-inner">
							<h6 class="contact-title"> Site Web</h6>
							<div class="contact-content">
								www.chocomarket.com
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<hr class="mt-4 mb-7" />
					<div class="text-center mb-1 section-pretitle">Laissez nous un message !</div>
					<div class="organik-seperator mb-6 center">
						<span class="sep-holder"><span class="sep-line"></span></span>
						<div class="sep-icon"><i class="organik-flower"></i></div>
						<span class="sep-holder"><span class="sep-line"></span></span>
					</div>
					<div class="contact-form-wrapper">
						<form  class="contact-form">
							<div class="row">
								<div class="row">
									<div class="col-md-12 error-text text-align-center">
										
									</div>
								</div>
								<input type="hidden" name="userT" 
								value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['token'] : '00000000'; ?>" />
								<div class="col-md-6">
									<label>Votre nom et prenoms <span class="required">*</span></label>
									<div class="form-wrap">
										<input type="text" name="your_name" 
										value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['nom'].' '.$_SESSION['user']['prenoms'] : ''; ?>" 
										size="255" required/>
									</div>
								</div>
								<div class="col-md-6">
									<label>Votre adresse email <span class="required">*</span></label>
									<div class="form-wrap">
										<input type="email" name="your_email" 
										value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['email'] : ''; ?>" size="100" required/>
									</div>
								</div>
							</div>
							<!-- required -->
							<div class="row">
								<div class="col-md-12">
									<label>Objet</label>
									<div class="form-wrap">
										<input type="text" name="your_subject" value="" size="150" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label>Message<span class="required">*</span></label>
									<div class="form-wrap">
										<textarea name="your_message" cols="40" rows="10" required></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-wrap text-center">
										<input type="submit" value="ENVOYER" />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
