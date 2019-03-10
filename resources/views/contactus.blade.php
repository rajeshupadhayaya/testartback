@extends('layouts.app')

@section('content')
<div class="container contactus-form">
		<section>
			<h2 class="text-center">Contact Us</h2>
			<form id="contact-form" style="min-width: 550px">
				<div class="form-group">
					
						
							<label for="email">Email Id *</label>
						
							<input type="email" class="form-control" id="email" name="email" required="required">
					
				</div>
				<div class="form-group">
							<label for="phone_no">Phone No *</label>
							<input type="number" class="form-control" id="phone_no" name="phone_no" required="required">
					
				</div>
				<div class="form-group">
							<label for="message">Message *</label>
							<textarea class="form-control" id="message" name="message" rows="5" required="required" minlength="20"></textarea>
					
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
				</div>
			</form>
		</section>
	
</div>
@endsection