<script src="/themes/admin/js/chart-js/Chart.js"></script>
<script src="/themes/admin/js/chartjs.init.js"></script>

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
            <?=Yii::t('adminModule.app','Красивый график');?>
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
            </header>
            <div class="panel-body">
                <div class="chartJS" style="height: 262px;">
                    <canvas id="line-chart-js" height="258" width="1603" style="width: 1603px; height: 258px;"></canvas>
                </div>
            </div>
        </section>
    </div>
</div>


<div class="row">

    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">
            <?=Yii::t('adminModule.app','Красивый график');?>
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
            </header>
            <div class="panel-body">
                <div class="chartJS" style="height: 262px;">
                    <canvas id="pie-chart-js" height="258" width="772" style="width: 772px; height: 258px;"></canvas>
                </div>
            </div>
        </section>
    </div>

    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">
            <?=Yii::t('adminModule.app','Красивый график');?>
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
            </header>
            <div class="panel-body">
                <div class="chartJS" style="height: 262px;">
                    <canvas id="donut-chart-js" height="258" width="772" style="width: 772px; height: 258px;"></canvas>
                </div>
            </div>
        </section>
    </div>

</div>
