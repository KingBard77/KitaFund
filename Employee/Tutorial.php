 <!--========== HOMEBOARD ==========-->
 <!-- Plugin css for this page -->

 <!-- End plugin css for this page -->

 <?php 
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Tutorial';
include ('../partials/Navbar - Employee.php');
include ('../partials/SettingPanel.php');
include ('../partials/Sidebar - Employee.php');
?>

 <div class="main-panel">
     <div class="content-wrapper">
         <div class="row">
             <div class="col-lg-6 grid-margin stretch-card">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="card-title">Solid content accordion</h4>
                         <p class="card-description">Use class <code>.accordion-solid-content</code> for basic accordion
                         </p>
                         <div class="mt-4">
                             <div class="accordion accordion-solid-content" id="accordion-5" role="tablist">
                                 <div class="card">
                                     <div class="card-header" role="tab" id="heading-13">
                                         <h6 class="mb-0">
                                             <a data-bs-toggle="collapse" href="#collapse-13" aria-expanded="true"
                                                 aria-controls="collapse-13">
                                                 How can I pay for an order I placed?
                                             </a>
                                         </h6>
                                     </div>
                                     <div id="collapse-13" class="collapse" role="tabpanel" 
                                         aria-labelledby="heading-13" data-parent="#accordion-5">
                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="col-3">
                                                     <img src="../../../../images/samples/300x300/10.jpg" class="mw-100"
                                                         alt="image" />
                                                 </div>
                                                 <div class="col-9">
                                                     <p class="mb-0">You can pay for the product you have purchased
                                                         using credit cards, debit cards, or via online banking.
                                                         We also on-delivery services.</p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header" role="tab" id="heading-14">
                                         <h6 class="mb-0">
                                             <a class="collapsed" data-bs-toggle="collapse" href="#collapse-14"
                                                 aria-expanded="false" aria-controls="collapse-14">
                                                 I can’t sign in to my account
                                             </a>
                                         </h6>
                                     </div>
                                     <div id="collapse-14" class="collapse" role="tabpanel" aria-labelledby="heading-14"
                                         data-parent="#accordion-5">
                                         <div class="card-body">
                                             <p>If while signing in to your account you see an error message, you can do
                                                 the following</p>
                                             <ol class="ps-3 mt-4">
                                                 <li>Check your network connection and try again</li>
                                                 <li>Make sure your account credentials are correct while signing in
                                                 </li>
                                                 <li>Check whether your account is accessible in your region</li>
                                             </ol>
                                             <br>
                                             <p class="text-danger">
                                                 <i class="ti-alert-octagon me-2"></i>If the problem persists, you can
                                                 contact our support.
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header" role="tab" id="heading-15">
                                         <h6 class="mb-0">
                                             <a class="collapsed" data-bs-toggle="collapse" href="#collapse-15"
                                                 aria-expanded="false" aria-controls="collapse-15">
                                                 Can I add money to the wallet?
                                             </a>
                                         </h6>
                                     </div>
                                     <div id="collapse-15" class="collapse" role="tabpanel" aria-labelledby="heading-15"
                                         data-parent="#accordion-5">
                                         <div class="card-body">
                                             <p class="mb-0">You can add money to the wallet for any future transaction
                                                 from your bank account using net-banking, or credit/debit card
                                                 transaction. The money in the wallet can be used for an easier and
                                                 faster transaction.</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <?php include('../partials/Footer.html'); ?>