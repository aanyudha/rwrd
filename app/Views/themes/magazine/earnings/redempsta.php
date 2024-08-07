<section class="section section-page">
    <div class="container-xl">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= trans("home"); ?></a></li>
                    <li class="breadcrumb-item active"><?= trans("red_stat"); ?></li>
                </ol>
            </nav>
            <h1 class="page-title"><?= trans("red_stat"); ?></h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <?= loadView('earnings/_tabs'); ?>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <div class="left">
                            <h3 class="box-title"><?= trans('red_stat'); ?></h3>
                        </div>
                        <div class="table-responsive table-payouts">
                            <table class="table table-striped" style="border-collapse: collapse; width: 100%; text-align: left;">
                                <thead style="background-color: #f2f2f2;">
                                <tr role="row">
                                    <th style="width: 5%; min-width: 40px; padding: 12px; border: 1px solid #ddd;">#</th>
                                    <th style="width: 35%; padding: 12px; border: 1px solid #ddd;"><?= trans('red-stat'); ?></th>
                                    <th style="width: 5%; padding: 12px; border: 1px solid #ddd;"><?= trans('qty-stat'); ?></th>
                                    <th style="width: 5%; padding: 12px; border: 1px solid #ddd;"><?= trans('pointunt-stat'); ?></th>
                                    <th style="width: 5%; padding: 12px; border: 1px solid #ddd;"><?= trans('point-stat'); ?></th>
                                    <th style="width: 15%; padding: 12px; border: 1px solid #ddd;"><?= trans('reqdate-stat'); ?></th>
                                    <th style="width: 10%; padding: 12px; border: 1px solid #ddd;"><?= trans('procdate-stat'); ?></th>
                                    <th style="width: 10%; padding: 12px; border: 1px solid #ddd;"><?= trans('claimed-stat'); ?></th>
                                    <th style="width: 10%; padding: 12px; border: 1px solid #ddd;"><?= trans('stat-stat'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $i=0;
                                foreach($history as $row) 
                                {
                                    $color = "primary";
                                    if($row->status == "Canceled")
                                    {
                                        $color = "danger";                    
                                    }
                                    if($row->status == "Approved")
                                    {
                                        $color = "info";                                        
                                    }
                                    if($row->status == "Claimed")
                                    {
                                        $color = "success";                                        
                                    }
                                    $i++;
                                    $tanggal_pengajuan = $row->tanggal_pengajuan == null ? "" : date("d-M-Y", strtotime($row->tanggal_pengajuan));
                                    $tanggal_proses = $row->tanggal_proses == null ? "" : date("d-M-Y", strtotime($row->tanggal_proses));
                                    $tanggal_claim = $row->tanggal_claim == null ? "" : date("d-M-Y", strtotime($row->tanggal_claim));
                                    echo "<tr style='border-bottom: 1px solid #ddd;'><td style='width: 5%; min-width: 40px; padding: 12px; border: 1px solid #ddd;'>$i</td><td style='width: 20%; padding: 12px; border: 1px solid #ddd;'>".$row->nama."</td><td style='width: 10%; padding: 12px; border: 1px solid #ddd;'>".$row->qty."</td><td style='width: 15%; padding: 12px; border: 1px solid #ddd; text-align: right;'>".$row->point."</td><td style='width: 15%; padding: 12px; border: 1px solid #ddd; text-align: right;'>".($row->qty*$row->point)."</td><td style='width: 15%; padding: 12px; border: 1px solid #ddd; text-align: right;'>".$tanggal_pengajuan."</td><td style='width: 10%; padding: 12px; border: 1px solid #ddd; text-align: right;'>".$tanggal_proses."</td><td style='width: 10%; padding: 12px; border: 1px solid #ddd; text-align: right;'>".$tanggal_claim."</td><td style='width: 10%; padding: 12px; border: 1px solid #ddd; text-align: right;'><span class='badge bg-".$color."'>".$row->status."</span></td></tr>";
                                } 
                                ?>
                                </tbody>
                            </table>
                          <?php if (empty($history)): ?>
                                <p class="text-center text-muted"><?= trans("no_records_found"); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                           <!-- ?= view('common/_pagination'); ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
