<!-- jQplot CSS -->
<!-- jQplot CSS END -->

                <h1 class="page-title">Dashboard</h1>
                <div class="container_12 clearfix leading ">
                    <section class="grid_12"> 
                        <div class="message info closeable">
                            <span class="message-close"></span>
                            <h3>Quick Help - Dashboard</h3> 
                            <p> 
                                Lorem ipsum dolor sit amet
                            </p> 
                            <ol> 
                                <li>Lorem ipsum</li> 
                                <li>dolor</li> 
                                <li>sit amet</li> 
                            </ol>
                        </div>
                    </section> 
                
                    <section class="portlet grid_6 leading"> 
                        <header>
                            <h2>Invoice Statistics</h2> 
                        </header>
                        <section>
                            <table class="full"> 
                                <tbody> 
                                    <tr> 
                                        <td>Total Invoices</td> 
                                        <td class="ar"><a href="#">30</a></td> 
                                        <td class="ar">1,498.50 $</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Total Paid</td> 
                                        <td class="ar"><a href="#">25</a></td> 
                                        <td class="ar">1,248.75 $</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Total Due</td> 
                                        <td class="ar"><a href="#">5</a></td> 
                                        <td class="ar">249.75 $</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Total Overdue</td> 
                                        <td class="ar">0</td> 
                                        <td class="ar">0.00 $</td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </section>
                    </section> 
 
                    <section class="portlet grid_6 leading"> 

                        <header>
                            <h2>Sales Statistics</h2>
                        </header>

                        <section>
                            <table class="full"> 
 
                                <tbody> 
 
                                    <tr> 
 
                                        <td>Signups This Month</td> 
 
                                        <td class="ar"><a href="#">30</a></td> 
 
                                        <td class="ar"></td> 
 
                                    </tr> 
 
                                    <tr> 
 
                                        <td>Sales This Month</td> 
 
                                        <td class="ar"><a href="#">25</a></td> 
 
                                        <td class="ar">1,248.75 $</td> 
 
                                    </tr> 
 
                                    <tr> 
 
                                        <td>Signups This Year</td> 
 
                                        <td class="ar"><a href="#">30</a></td> 
 
                                        <td class="ar"></td> 
 
                                    </tr> 
 
                                    <tr> 
 
                                        <td>Sales This Year</td> 
 
                                        <td class="ar"><a href="#">25</a></td> 
 
                                        <td class="ar">1,248.75 $</td> 
 
                                    </tr> 
 
                                </tbody> 
 
                            </table>
                            
                        </section>

                    </section> 
 
                    <div class="clear"></div>

                    <section class="portlet grid_6 leading"> 
                        <header>
                            <h2>Client Statistics: <a href="#">30</a></h2>
                        </header>
                        <section>
                            <table class="full">
                                <tbody> 
                                    <tr> 
                                        <td>Active</td> 
                                        <td style="width:70%"><div id="progress1" class="progress"><span style="width: 50%;"><b>50%</b></span></div></td> 
                                        <td style="width:40px" class="ar">15/30</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Pending</td> 
                                        <td><div class="progress"><span style="width: 10%;"><b>10%</b></span></div></td> 
                                        <td class="ar">3/30</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Suspended</td> 
                                        <td><div class="progress"><span style="width: 6%;"><b>6%</b></span></div></td> 
                                        <td class="ar">2/30</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Cancelled</td> 
                                        <td><div class="progress"><span style="width: 16%;"><b>16%</b></span></div></td> 
                                        <td class="ar">5/30</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Error</td> 
                                        <td><div class="progress"><span style="width: 16%;"><b>16%</b></span></div></td> 
                                        <td class="ar">5/30</td> 
                                    </tr>
                                </tbody> 
                            </table>
                        </section>
                    </section>
 
                    <section class="portlet grid_6 leading"> 
                        <header>
                            <h2>Profits, Expenses and Sales </h2>
                        </header>
                        <section>
                            <div class="jqPlot" id="chart2" style="width:100%;height:160px;"></div>
                        </section>
                    </section> 
                    <div class="clear"></div>
                </div>

    <script type="text/javascript">
    $(document).ready(function(){
        var line1 = [1,4, 9, 16];
        var line2 = [25, 12.5, 6.25, 3.125];
        var line3 = [2, 7, 15, 30];
        var plot2 = $.jqplot('chart2', [line1, line2, line3], {
            show: true,
            legend:{show:true, location:'ne', xoffset:0},
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer, 
                rendererOptions:{barPadding: 8, barMargin: 10, shadowDepth: 2}
            },
            series:[
                {label:'Profits'}, 
                {label:'Expenses'}, 
                {label:'Sales'}
            ],
            axes:{
                xaxis:{
                    renderer:$.jqplot.CategoryAxisRenderer, 
                    ticks:['1st Qtr', '2nd Qtr', '3rd Qtr', '4th Qtr']
                }, 
                yaxis:{min:0}
            }
        });
    });
    </script>
    <!-- jQplot SETUP END -->