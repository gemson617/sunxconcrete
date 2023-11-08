<style>
    :root {
        --color-blue: #1777E5;
        --color-blue-light: #D7E8FC;
        --color-blue-ultra-light: #EDF4FC;
        --color-dark-grey: #46494D;
        --color-border: #C2D8F2;
        --color-red-light: #F2DDDA;
        --color-red: #E0351B;

        --container-width: 1080px;
        --form-control-height: 50px;

        --base-font: 'Roboto', sans-serif;
    }

    .eye {
        width: 13px;
        height: 13px;
        border: solid 1px #1777e5;
        border-radius: 75% 15%;
        transform: rotate(45deg);
        opacity: .75;
        position: absolute;
        top: 19px;
        right: 13px;
        cursor: pointer;
        z-index: 200;
    }

    .eye.closed {
        background: #1777e5;
        opacity: .5;
    }

    .eye:before {
        content: '';
        display: block;
        position: absolute;
        width: 5px;
        height: 5px;
        border: solid 1px #1777e5;
        border-radius: 50%;
        left: 3px;
        top: 3px;
    }

    .form-control {
        background-color: #fff;
        min-height: var(--form-control-height);
        color: var(--color-dark-grey);
        border: 1px solid var(--color-border);
        border-radius: 5px;
        font-size: 15px;
        padding: 12px 20px;
        font-family: var(--base-font);
        box-sizing: border-box;
    }

    .control {
        position: relative;
    }

    button.form-control {
        background: royalblue;
        color: #fff;
    }

    .rez {
        width: 200px;
        margin: 10px 0;
    }
</style>
<div class="page-content">
    <div class="container">
        <!-- start page title -->
        
        <div class="row">
            <div class="col-6">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Edit Product</h4>                    
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <div class="page-title-box d-flex ">
                    <div class="page-title-right ml-auto">  
                        <a href="<?php echo site_url('product'); ?>">
                        <button class="btn btn-secondary">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?php
        if ($this->session->flashdata('alert_success')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
            </div>
        <?php
        }

        if ($this->session->flashdata('alert_danger')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
            </div>
        <?php
        }

        if ($this->session->flashdata('alert_warning')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
            </div>
        <?php
        }
        ?>
         <!-- <?php foreach($hsn_code as $hsn)
                                            {
         echo '<pre>';
        print_r( $hsn);
                                            }?>       -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo site_url('Product/edit/'. $default['product_id']); ?>" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" value="<?php echo $default['product_name']; ?>" class="form-control" id="product_name" placeholder="Enter Product Name"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        Product Name Required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">HSN Code</label>
                                        <?php foreach($hsn_code as $u)
                                            {
                                                if($u->hsn_id == $default['hsn_code'])
                                                {
                                                    $hsn_name = $u->hsn_name;
                                                }
                                           }?>

                                            <select class="form-control" name="hsn_code" id="user_id" required>
                                            <option value="<?php echo $default['hsn_code']; ?>"><?php echo $hsn_name; ?></option>
                                            
                                            <?php foreach($hsn_code as $hsn)
                                            {?>
                                            <option value="<?php echo $hsn->hsn_id; ?>"><?php echo $hsn->hsn_name; ?></option>
                                            <?php }?>
                                            
                                        </select>                                        
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        HSN Code Required.
                                        </div>
                                    </div>
                                </div>                                
                                <!-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">UOM</label>
                                        <?php foreach($uom as $u)
                                            {
                                                if($u->uom_id == $default['uom'])
                                                {
                                                    $uom_name = $u->uom;
                                                }
                                           }?>
                                        <select class="form-control" name="uom" id="uom" required>
                                            <option value="<?php echo $default['hsn_code']; ?>"><?php echo $uom_name; ?></option>
                                            <?php foreach($uom as $u)
                                            {?>
                                            <option value="<?php echo $u->uom_id; ?>"><?php echo $u->uom; ?>
                                            <?php }?>
                                        </select>                                              <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        UOM Required.
                                        </div>
                                    </div>
                                </div>                                 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control" id="price" placeholder="Enter Price" value="<?php echo $default['price']; ?>" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                        price Required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
                                <a href="<?php echo site_url('Product'); ?>"><button class="btn btn-warning" type="button">Back</button></a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>