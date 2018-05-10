
<?php

// install contact form 7 plugin and edit
//---------------------------------------
<div class="stock-contact-form">
<h2>Get a free quote</h2>
<div class="row">
<div class="col-md-6">
<label>Your name *</label>
[text* name placeholder "enter your name"]
</div>
<div class="col-md-6">
<label>Your email*</label>
[email* email placeholder "john@mail.com"]
</div>
</div>

<div class="row">
<div class="col-md-6">
<label>phone number</label>
[tel* phone placeholder "xxx- xxx- xxx"]
</div>
<div class="col-md-6">
<label>Topic</label>
<span class="select-container">[select* topic "Select a topic" "Topic 1" "Topic 2"]</span>
</div>
</div>

<button type="submit">Get a call back <i class="fa fa-angle-right"></i></button>
</div>


// stock-toolkit.css
//-----------------------------
/*Contact form*/
input[type=text], input[type=email], input[type=tel], input[type=search], input[type=password], textarea{ background: #f5f8f9;
border: 1px solid #e8eef1;
max-width: 100%;
padding: 15px;
}
input[type=submit], button[type=submit]{
background: #278cc1;
border: none;
padding: 16px 28px;
color: #fff;
font-weight: 700;
text-transform: uppercase;
}
.stock-contact-form input{
    margin-bottom: 25px;
    
}
.stock-contact-form h1{
    margin-bottom: 41px;   
}
button[type="submit"] i.fa{
    font-size: 138%;
    padding-left: 10px;
}
.vc_row.bg-left-bottom{
background-size:670px;
}
.select-container{
	background:#f5f8f9;
	display:inline-block;
	width:100%;
	border:1px solid #eBeef1;
	padding:15px;
}
.select-container select{
width:100%;
}




?>