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
             <div class="col-lg-12 grid-margin stretch-card">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="card-title">Frequently Asked Question</h4>
                         <p class="card-description">A<code>Step-by-Step</code>Guide</p>
                         <div class="mt-4">
                             <div class="accordion accordion-solid-header" id="accordion">
                                 <div class="card">
                                     <div class="card-header">
                                         <a class="card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseOne">
                                             <b>Choose your Meat</b>
                                         </a>
                                     </div>
                                     <div id="collapseOne" class="collapse">
                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="col-3">
                                                     <img src="../Images/Index/Tutorial1.png" class="mw-100"
                                                         alt="image" />
                                                 </div>
                                                 <div class="col-9">
                                                     <p class="mb-0">You want your burger to remain juicy so avoid going
                                                         too lean. Choose a standard minced meat (usually around 20 %
                                                         fat) or if you are set on leaner cuisine then 10 % fat is ok,
                                                         don't go for less. Beef is the typical meat used in burgers but
                                                         you could use lamb or beef, or a mixture of beef and chicken.</p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header">
                                         <a class="card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseFive">
                                             <b>Ingredients</b>
                                         </a>
                                     </div>
                                     <div id="collapseFive" class="collapse">
                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="col-4">
                                                     <p class="mb-0"><b>For the Burger:</b></p>
                                                     <ul class="ps-3 mt-4">
                                                         <li>Beef Burger Patty</li>
                                                         <li>Hamburger bun</li>
                                                         <li>Lettuce</li>
                                                         <li>Tomato</li>
                                                         <li>Pickled Cucumber</li>
                                                         <li>Cooking Oil</li>
                                                         <li>Ketchup</li>
                                                         <li>Mayonnaise</li>
                                                         <li>Butter</li>
                                                         <li>150 grams French Fries</li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-4">
                                                     <p class="mb-0"><b>For the Egg Mixture:</b></p>
                                                     <ul class="ps-3 mt-4">
                                                         <li>2 eggs, beaten</li>
                                                         <li>1 teaspoon salt</li>
                                                         <li>1/2 teaspoon pepper</li>
                                                     </ul>
                                                 </div>
                                                 <div class="col-4">
                                                     <p class="mb-0"><b>For Preparation:</b></p>
                                                     <ul class="ps-3 mt-4">
                                                         <li>2 Large Bowl</li>
                                                         <li>2 Small Bowl</li>
                                                         <li>Chopping Board</li>
                                                         <li>Knife</li>
                                                     </ul>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header">
                                         <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseFour">
                                             <b>Cook Time</b>
                                         </a>
                                     </div>
                                     <div id="collapseFour" class="collapse">
                                         <div class="card-body">
                                             <p>Here is all the cooking time to make the best burger in BurgerByte
                                                 Company.
                                                 All the time used can be applied to all types of patties depends on
                                                 situation.</p>
                                             <br>
                                             <table class="table table-hover" width="80%" align="center">
                                                 <tr>
                                                     <th class="text-center">Prep time</th>
                                                     <th class="text-center">Cook time</th>
                                                     <th class="text-center">Ready in</th>
                                                     <th class="text-center">Yields</th>
                                                 </tr>
                                                 <tr>
                                                     <td class="text-center">25 seconds</td>
                                                     <td class="text-center">12 min</td>
                                                     <td class="text-center">13 min</td>
                                                     <td class="text-center">1 serving</td>
                                                 </tr>
                                             </table>
                                             <br>
                                             <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                                                 <i class="ti-alert-octagon me-2"></i>If the problem persists, you can
                                                 contact your owner.
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header">
                                         <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseTwo">
                                             <b>Instructions</b>
                                         </a>
                                     </div>
                                     <div id="collapseTwo" class="collapse">
                                         <div class="card-body">
                                             <p>Here is all the instruction to make the best burger in BurgerByte
                                                 Company.
                                                 All the methods used can be applied to all types of patties depends on
                                                 situation.</p>
                                             <ol class="ps-3 mt-4">
                                                 <li>Clean and slice all of the vegetables. Set aside.</li>
                                                 <li>Cook burger patty according to instructions. Set aside.</li>
                                                 <li>Deep-fry French fries until slightly golden brown. Remove from the
                                                     heat.</li>
                                                 <li>In a frying pan, cook beaten eggs in omelet form. Let the bottom
                                                     set before adding the burger patty in the middle.</li>
                                                 <li>Cover the burger patty with an omelet by folding each side. Flip
                                                     and cook until the omelet is set.</li>
                                                 <li>Re-fry French fries until golden brown or crispy. Remove from the
                                                     heat. Season with salt.</li>
                                                 <li>Toast buns with butter.</li>
                                                 <li>Assemble the Ramly burger. Spread some mayonnaise and ketchup on
                                                     the bottom half of the bun.</li>
                                                 <li>Arrange the lettuce, burger patty wrapped with an omelette, pickled
                                                     cucumber, and tomato.
                                                     Finally, top with the top half of the bun.
                                                 <li>Transfer the Ramly burger to a plate with French fries on the side.
                                                 </li>
                                                 <li>Serve with your favorite drink and French fries condiment.</li>
                                             </ol>
                                             <br>
                                             <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                                                 <i class="ti-alert-octagon me-2"></i>If the problem persists, you can
                                                 contact your owner.
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header">
                                         <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseThree">
                                             <b>Tips & Techniques</b>
                                         </a>
                                     </div>
                                     <div id="collapseThree" class="collapse">
                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="col-9">
                                                     <ol class="ps-3 mt-4">
                                                         <li>
                                                             <p class="mb-0">You may season the egg with other
                                                                 seasonings if
                                                                 you
                                                                 wish.
                                                             </p>
                                                         </li>
                                                         <li>
                                                             <p class="mb-0">Double-frying the French fries produces a
                                                                 crunchier
                                                                 exterior texture.</p>
                                                         </li>
                                                         <li>
                                                             <p class="mb-0">Sprinkle salt on French fries before
                                                                 serving.
                                                             </p>
                                                         </li>
                                                         <li>
                                                             <p class="mb-0">For the burger patties, try using a
                                                                 different
                                                                 kind
                                                                 of meat,
                                                                 such as chicken or lamb.</p>
                                                         </li>
                                                     </ol>
                                                 </div>
                                                 <div class="col-3">
                                                     <img src="../Images/Index/Tutorial2.png" class="mw-100"
                                                         alt="image" />
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="card">
                                     <div class="card-header">
                                         <a class="collapsed card-link" data-toggle="collapse" data-parent="#accordion"
                                             href="#collapseSix">
                                             <b>Standard Operating Procedures</b>
                                         </a>
                                     </div>
                                     <div id="collapseSix" class="collapse">
                                         <div class="card-body">
                                             <div class="row">
                                                 <div class="col-12">
                                                     <img src="../Images/Index/SOP.jpg" class="mw-100"
                                                         alt="image" />
                                                 </div>
                                             </div>
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