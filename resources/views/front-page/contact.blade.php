@extends('layouts.guest')
@section('content')

@include('front-page.includes.breadcrumb')

<style>
    * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

 
.section-header {
  margin-bottom: 50px;
  text-align: center;
}
 
.section-header h2 {
  color: #000;
  font-weight: bold;
  font-size: 3em;
  margin-bottom: 20px;
}
 
.section-header p {
  color: #000;
}
 
.row  {
  display: flex;
  flwx-wrap: wrap;
  align-items: center;
  justify-content: space-between;
}
 
.contact-info {
  width: 50%;
}
 
.contact-info-item {
  display: flex;
  margin-bottom: 30px;
}
 
.contact-info-icon {
  height: 70px;
  width: 70px;
  background-color: #fff;
  text-align: center;
  border-radius: 50%;
}
 
.contact-info-icon i {
  font-size: 30px;
  line-height: 70px;
}
 
.contact-info-content {
  margin-left: 20px;
}
 
.contact-info-content h4 {
  color: #1da9c0;
  font-size: 1.4em;
  margin-bottom: 5px;
}
 
.contact-info-content p {
  color: #000;
  font-size: 1em;
}
 
.contact-form {
  background-color: #fff;
  padding: 40px;
  width: 45%;
  padding-bottom: 20px;
  padding-top: 20px;
}
 
.contact-form h2 {
  font-weight: bold;
  font-size: 2em;
  margin-bottom: 10px;
  color: #333;
}
 
.contact-form .input-box {
  position: relative;
  width: 100%;
  margin-top: 10px;
}
 
.contact-form .input-box input,
.contact-form .input-box textarea{
  width: 100%;
  padding: 5px 0;
  font-size: 16px;
  margin: 10px 0;
  border: none;
  border-bottom: 2px solid #333;
  outline: none;
  resize: none;
}
 
.contact-form .input-box span {
  position: absolute;
  left: 0;
  padding: 5px 0;
  font-size: 16px;
  margin: 10px 0;
  pointer-events: none;
  transition: 0.5s;
  color: #666;
}
 
.contact-form .input-box input:focus ~ span,
.contact-form .input-box textarea:focus ~ span{
  color: #e91e63;
  font-size: 12px;
  transform: translateY(-20px);
}
 
.contact-form .input-box input[type="submit"]
{
  width: 100%;
  background: #00bcd4;
  color: #FFF;
  border: none;
  cursor: pointer;
  padding: 10px;
  font-size: 18px;
  border: 1px solid #00bcd4;
  transition: 0.5s;
}
 
.contact-form .input-box input[type="submit"]:hover
{
  background: #FFF;
  color: #00bcd4;
}
 
@media (max-width: 991px) {
  section {
    padding-top: 50px;
    padding-bottom: 50px;
  }
  
  .row {
    flex-direction: column;
  }
  
  .contact-info {
    margin-bottom: 40px;
    width: 100%;
  }
  
  .contact-form {
    width: 100%;
  }
}
</style>

<section class="mt-5">
    
    <div class="section-header">
      <div class="container">
        <h2>Contact Us</h2>
        <p>Let's connect together with inkindi tours</p>
      </div>
    </div>
    
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 contact-info">
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-home"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Address</h4>
              <p>Kicukiro,<br/> Kigali, <br/>Rwanda</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-phone"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Phone</h4>
              <a href="+250781313607">+250 781 313 607</a>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            
            <div class="contact-info-content">
              <h4>Email</h4>
             <p>shemachretien29@gmail.com</p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 contact-form">
          <form action="" id="contact-form">
            <h2>Send Message</h2>
            <div class="input-box">
              <input type="text" required="true" name="">
              <span>Full Name</span>
            </div>
            
            <div class="input-box">
              <input type="email" required="true" name="">
              <span>Email</span>
            </div>
            
            <div class="input-box">
              <textarea required="true" name=""></textarea>
              <span>Type your Message...</span>
            </div>
            
            <div class="input-box">
              <input type="submit" value="Send" name="">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </section>
@endsection