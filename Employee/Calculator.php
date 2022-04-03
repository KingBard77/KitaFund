<!--========== INVOICE CALCULATION  ==========-->

<!-- Plugin css for this page -->

<!-- End plugin css for this page -->

<?php
// This function outputs theoretical HTML
// for adding ads to a Web page.

$page_title = 'Calculator';
include '../partials/Navbar - Employee.php';
include '../partials/SettingPanel.php';
include '../partials/Sidebar - Employee.php';
?>

<div class='main-panel'>
    <div class='content-wrapper'>
        <div class="row">
            <div class='col-lg-12 grid-margin stretch-card'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>Sales Invoices Calculator</h4>
                        <p class='card-description'>
                            Use this calculator to Calculate Sales 
                        </p>
                        <button href="#Bar" class="btn btn-primary mr-2" style="float: right;"
                            data-toggle="collapse">Click a Calculator</button><br /><br /><br />
                        <div id="Bar" class="collapse in">
                            <form action="Invoice_Calculation.php" method="POST" class="">
                                <!-- Table Stock -->
                                <div class="table-responsive">
                                    <table class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>PRODUCT</th>
                                                <th class="text-center">OPEN</th>
                                                <th class="text-center">CLOSE</th>
                                                <th class="text-center">QUANITITY</th>
                                                <th class="text-center">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--========== BUNS BURGER ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Burger Buns</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_1"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_1"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_1"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_1"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== BUNS OBLONG ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Oblong Buns</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_2"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_2"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_2"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_2"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== BUNS SAUSAGE ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Sausage Buns</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_3"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_3"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_3"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_3"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== CHICKEN ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Chicken</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_4"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_4"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_4"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_4"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== MEAT ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Meat</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_5"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_5"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_5"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_5"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== LAMB ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Lamb</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_6"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_6"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_6"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_6"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== SAUSAGE ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Sausage</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_7"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_7"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_7"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_7"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== CRISPY ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Crispy</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_8"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_8"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_8"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_8"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== OBLONG MEAT ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Meat Oblong</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_9"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_9"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_9"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_9"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== OBLONG CHICKEN ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Chicken Oblong</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_10"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_10"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_10"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_10"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== CHEESE ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Cheese</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_11"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_11"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_11"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_11"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== EGG ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Egg</label></td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qin_12"
                                                            placeholder="Insert Open Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qout_12"
                                                            placeholder="Insert Close Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-sm-9">
                                                        <input type="number" id="bal_12"
                                                            placeholder="Insert Balance Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="sub_12"
                                                            placeholder="Retrieve SubTotal Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" disabled/>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table Invoice -->
                                <div class="table-responsive">
                                    <table class="table table-hover" style="width:100%">
                                        <thead>
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                        </thead>
                                        <tbody>
                                            <!--========== SUB TOTAL 1 ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td class="text-right"><label class="col-sm-3 col-form-label">Sub
                                                        Total 1</label></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total"
                                                            placeholder="Enter Daily Stock Sales Eg:- RM 1.20"
                                                            step="0.01" class="form-control form-control-sm"
                                                            name="Total" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT BURGER / SAUSAGE BUNS ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Burger /
                                                        Sausage
                                                        Buns</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 1.70 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty1"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total1"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 1.70"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT OBLONG BUNS ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Oblong
                                                        Buns</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 2.70 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty2"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total2"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 2.70"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT CHICKEN / BEEF / SAUSAGE ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Chicken /
                                                        Beef /
                                                        Sausage</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 1.80 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty3"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total3"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 1.80"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT BEEF / CHICKEN OBLONG ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Lamb / Beef /
                                                        Chicken
                                                        Oblong</label></td>
                                                <td><label class="col-sm-3 col-form-label">RM 3.60 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty4"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total4"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 3.60"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT CRSIPY ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Crispy</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 2.60 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty5"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total5"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 2.60"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT EGG ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Egg</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 1.20 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty6"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total6"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 1.20"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== REJECT CHEESE ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Cheese</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 1.40 / 1
                                                        pieces</label></td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="qty7"
                                                            placeholder="Insert Reject Quantity Eg:- 5"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Sub_Total7"
                                                            placeholder="Retrieve SubTotal from Quantity * RM 1.40"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== STAFF FOOD ==========-->
                                            <tr>
                                                <td><label class="col-sm-3 col-form-label">Staff
                                                        Food</label>
                                                </td>
                                                <td><label class="col-sm-3 col-form-label">RM 5.00 /
                                                        Staff</label>
                                                </td>
                                                <td>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="stafffood"
                                                            placeholder="Enter Staff Food Eg:- RM 1.20" step="0.01"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="text" id="Sub_Total8" step="0.01"
                                                            placeholder="Retrieve SubTotal from Staff Food"
                                                            placeholder="" class="form-control form-control-sm"
                                                            disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== TOTAL 2 ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">Sub
                                                        Total 2
                                                        <b class='text-danger'>(-)</b></label></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="text" id="Total_2"
                                                            placeholder="Retrieve SubTotal 2"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== TOTAL 3 ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label"><b>Total</b>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="text" id="Total_3"
                                                            placeholder="Retrieve Total from SubTotal 1 - SubTotal 2"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== FOOD PANDA ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">Food
                                                        Panda
                                                        <b class='text-success'>(+)</b></label></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="FoodPanda" step="0.01"
                                                            placeholder="Enter Food Panda Eg:- RM 1.20"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== E - WALLET ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">E -
                                                        Wallet <b class='text-success'>(+)</b></label>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="OnlineBanking" step="0.01"
                                                            placeholder="Enter E - Wallet Eg:- RM 1.20"
                                                            class="form-control form-control-sm" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== Overhead ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">Overhead
                                                        <b class='text-success'>(+)</b></label></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="Overhead" step="0.01"
                                                            placeholder="Enter Overhead Eg:- RM 1.20"
                                                            class="form-control form-control-sm" name="Overhead" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== CASH IN HAND ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">Cash in
                                                        Hand <b class='text-success'>(+)</b></label>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="CashInHand" step="0.01"
                                                            placeholder="Enter Cash in Hand Eg:- RM 1.20"
                                                            class="form-control form-control-sm" name="Total_Cash" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== TOTAL SALES ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">
                                                        <b>Total Sales</b></label></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="TotalSales"
                                                            placeholder="Enter Total Sales Eg:- RM 1.20" step="0.01"
                                                            class="form-control form-control-sm" name="Total_Sales" />
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--========== PROFIT / SHOT +/- ==========-->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td align="right"><label class="col-sm-3 col-form-label">Profit
                                                        / Shot <b class='text-success'>(+</b><b>/</b><b
                                                            class='text-danger'>-)</b></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text bg-primary text-white">RM</span>
                                                        </div>
                                                        <input type="number" id="GrandTotal" step="0.01"
                                                            placeholder="Retrieve Profit / Shot from Total Sales - Total"
                                                            class="form-control form-control-sm" disabled />
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-12" align="right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn btn-light" name="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                        <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i>
                            Every day each of stall will be going to get <b> RM 30.00 </b> as business start - up
                            money.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(document).ready(function() {
            // Get value on keyup funtion
            $(" #qin_1, #qin_2, #qin_3, #qin_4, #qin_5, #qin_6, #qin_7, #qin_8, #qin_9, #qin_10, #qin_11, #qin_12, #qout_1, #qout_2, #qout_3, #qout_4, #qout_5, #qout_6, #qout_7, #qout_8, #qout_9, #qout_10, #qout_11, #qout_12")
                .keyup(function() {

                    var bal_1, bal_2, bal_3, bal_4, bal_5, bal_6,
                        bal_7, bal_8, bal_9, bal_10, bal_11, bal_12,
                        sub_1, sub_2, sub_3, sub_4, sub_5, sub_6,
                        sub_7, sub_8, sub_9, sub_10, sub_11, sub_12 = 0;


                    var qin_1 = Number($("#qin_1").val());
                    var qout_1 = Number($("#qout_1").val());

                    var qin_2 = Number($("#qin_2").val());
                    var qout_2 = Number($("#qout_2").val());

                    var qin_3 = Number($("#qin_3").val());
                    var qout_3 = Number($("#qout_3").val());

                    var qin_4 = Number($("#qin_4").val());
                    var qout_4 = Number($("#qout_4").val());

                    var qin_5 = Number($("#qin_5").val());
                    var qout_5 = Number($("#qout_5").val());

                    var qin_6 = Number($("#qin_6").val());
                    var qout_6 = Number($("#qout_6").val());

                    var qin_7 = Number($("#qin_7").val());
                    var qout_7 = Number($("#qout_7").val());

                    var qin_8 = Number($("#qin_8").val());
                    var qout_8 = Number($("#qout_8").val());

                    var qin_9 = Number($("#qin_9").val());
                    var qout_9 = Number($("#qout_9").val());

                    var qin_10 = Number($("#qin_10").val());
                    var qout_10 = Number($("#qout_10").val());

                    var qin_11 = Number($("#qin_11").val());
                    var qout_11 = Number($("#qout_11").val());

                    var qin_12 = Number($("#qin_12").val());
                    var qout_12 = Number($("#qout_12").val());


                    //Formula Balance for Ervery Stock
                    var quantity1 = qin_1 - qout_1;
                    var quantity2 = qin_2 - qout_2;
                    var quantity3 = qin_3 - qout_3;
                    var quantity4 = qin_4 - qout_4;
                    var quantity5 = qin_5 - qout_5;
                    var quantity6 = qin_6 - qout_6;
                    var quantity7 = qin_7 - qout_7;
                    var quantity8 = qin_8 - qout_8;
                    var quantity9 = qin_9 - qout_9;
                    var quantity10 = qin_10 - qout_10;
                    var quantity11 = qin_11 - qout_11;
                    var quantity12 = qin_12 - qout_12;


                    //Formula Multiple for Ervery Stock
                    var BurgerBuns = 1.7 * quantity1;
                    var OblongBuns = 2.7 * quantity2;
                    var SausageBuns = 1.7 * quantity3;
                    var Chicken = 1.8 * quantity4;
                    var Meat = 1.8 * quantity5;
                    var Lamb = 3.6 * quantity6;
                    var Sausage = 1.8 * quantity7;
                    var Crispy = 2.6 * quantity8;
                    var MeatOblong = 3.6 * quantity9;
                    var ChickenOblong = 3.6 * quantity10;
                    var Cheese = 1.4 * quantity11;
                    var Egg = 1.2 * quantity12;

                    var AllStock = BurgerBuns + OblongBuns + SausageBuns + Chicken +
                        Meat + Lamb + Sausage + Crispy + MeatOblong + ChickenOblong +
                        Cheese + Egg;

                    $('#bal_1').val(quantity1);
                    $('#bal_2').val(quantity2);
                    $('#bal_3').val(quantity3);
                    $('#bal_4').val(quantity4);
                    $('#bal_5').val(quantity5);
                    $('#bal_6').val(quantity6);
                    $('#bal_7').val(quantity7);
                    $('#bal_8').val(quantity8);
                    $('#bal_9').val(quantity9);
                    $('#bal_10').val(quantity10);
                    $('#bal_11').val(quantity11);
                    $('#bal_12').val(quantity12);

                    $('#sub_1').val(BurgerBuns);
                    $('#sub_2').val(OblongBuns);
                    $('#sub_3').val(SausageBuns);
                    $('#sub_4').val(Chicken);
                    $('#sub_5').val(Meat);
                    $('#sub_6').val(Lamb);
                    $('#sub_7').val(Sausage);
                    $('#sub_8').val(Crispy);
                    $('#sub_9').val(MeatOblong);
                    $('#sub_10').val(ChickenOblong);
                    $('#sub_11').val(Cheese);
                    $('#sub_12').val(Egg);

                    $('#Sub_Total').val(AllStock);

                });
        });
        $(document).ready(function() {
            // Get value on keyup funtion
            $(" #qty1, #qty2, #qty3, #qty4, #qty5, #qty6, #qty7, #qty8 #stafffood, #FoodPanda, #OnlineBanking, #Overhead, #CashInHand")
                .keyup(function() {

                    var Sub_Total, Sub_Total1, Sub_Total2, Sub_Total3, Sub_Total4, Sub_Total5,
                        Sub_Total6, Sub_Total7, Sub_Total8, stafffood,
                        Total_1, Total_2, Total_3, TotalSales, GrandTotal = 0;

                    var Sub_Total = Number($("#Sub_Total").val());
                    var qty1 = Number($("#qty1").val());
                    var qty2 = Number($("#qty2").val());
                    var qty3 = Number($("#qty3").val());
                    var qty4 = Number($("#qty4").val());
                    var qty5 = Number($("#qty5").val());
                    var qty6 = Number($("#qty6").val());
                    var qty7 = Number($("#qty7").val());
                    var qty8 = Number($("#qty8").val());
                    var stafffood = Number($("#stafffood").val());

                    var FoodPanda = Number($("#FoodPanda").val());
                    var OnlineBanking = Number($("#OnlineBanking").val());
                    var Overhead = Number($("#Overhead").val());
                    var CashInHand = Number($("#CashInHand").val());

                    var Sub_Total1 = 1.7 * qty1;
                    var Sub_Total2 = 2.7 * qty2;
                    var Sub_Total3 = 1.8 * qty3;
                    var Sub_Total4 = 3.6 * qty4;
                    var Sub_Total5 = 2.6 * qty5;
                    var Sub_Total6 = 1.2 * qty6;
                    var Sub_Total7 = 1.4 * qty7;
                    var Sub_Total8 = stafffood;

                    //Calculation Total 1 for Stock #Sub_Total
                    Total_1 = Sub_Total

                    //Calculation Total 2 for Reject Stock #Sub Total 2
                    var Total_2 = Sub_Total1 + Sub_Total2 + Sub_Total3 + Sub_Total4 +
                        Sub_Total5 + Sub_Total6 + Sub_Total7 + Sub_Total8;

                    //Calculation Total 3 for (Total_1 - #Total_2)
                    var Total_3 = (Total_1 - Total_2);

                    var TotalSales = FoodPanda + OnlineBanking + Overhead + CashInHand;

                    var GrandTotal = TotalSales - Total_3;

                    $('#Sub_Total1').val(Sub_Total1);
                    $('#Sub_Total2').val(Sub_Total2);
                    $('#Sub_Total3').val(Sub_Total3);
                    $('#Sub_Total4').val(Sub_Total4);
                    $('#Sub_Total5').val(Sub_Total5);
                    $('#Sub_Total6').val(Sub_Total6);
                    $('#Sub_Total7').val(Sub_Total7);
                    $('#Sub_Total8').val(Sub_Total8);

                    $('#Sub_Total').val(Sub_Total);
                    $('#Total_1').val(Total_1);
                    $('#Total_2').val(Total_2);
                    $('#Total_3').val(Total_3);
                    $('#TotalSales').val(TotalSales);
                    $('#GrandTotal').val(GrandTotal);

                });
        });
        </script>

        <!--========== INCLUDE FOOTER ==========-->
        <?php include '../partials/Footer.html';?>