
<!DOCTYPE html>
<html lang="en">


<!-- Volt CSS -->
<link type="text/css" href="{{asset('css/volt.css')}}" rel="stylesheet">

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

<style type="text/css">
    body{
        background-color: white !important;
    }
    td{
        padding: 5px !important;
    }
</style>

</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    

    <main>
        <section class="justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                        <div>
                            <p class="mt-2 lead"><b>吉兰丹东马岸温府王爷庙</br>PERSATUAN PENGANUT AGAMA BUDDHA OON HU ONG EAR TEMANGAN</b></p>
                            <p>LOT PT. 192, JALAN DEPAN STESYEN KERETAPI, 18400 TEMANGAN, KELANTAN.</br>(No. Pendaftaran: 60) </p>

                            @foreach($payments as $payment)
                                 @if($loop->first)
                            <p><span><b>No:</b> {{$payment->receipt_no}}</span> - <span><b>Tarikh:</b> {{$payment->payment_date}}</span></p>
                            

                             <p>庙   缘   银</br><span style="text-decoration: underline;">RESIT YURAN TAHUNAN</span></p>

                             <table class="table table-bordered border-primary">
                                  
                                  <tbody>
                                    <tr>
                             
                                      <td>家属姓名</br>Nama Ketua Keluarga</td>
                                      <td>{{$payment->member->gvBrowseCompanyName}}</td>
                                      <td>乡区</br>Kawasan</td>
                                      <td>{{$payment->member->area->area_name}}</td>
                                    </tr>
                                    <tr>
                                      <td>会员编号</br>No. Ahli</td>
                                      <td>
                                      @foreach($payments as $payment)
                                        {{$payment->member_id}},
                                        @endforeach
                                      </td>
                                      <td>缴费年份</br>Bayaran Tahunan</td>
                                      <td>
                                      @foreach($payment->paymentDetails as $paymentDetails) 
                {{$paymentDetails->parentItem->title}},
            @endforeach
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>每名会员</br>Setiap Ahli</td>
                                      <td>
                                         @foreach($payment->paymentDetails as $paymentDetails)
                                            @if($loop->first)
                                            RM {{$paymentDetails->parentItem->amount}}
                                            @endif
                                        @endforeach
                                      </td>
                                 @endif 
                            @endforeach
                                      <td>总共 (年)</br>Jumlah Tahun</td>
                                      <td>{{$member_count}}</td>
                                    </tr>
                                    <tr>
                                      <td>家属人数</br>Bilangan Ahli Keluarga</td>
                                      <td>{{$year_count}}</td>
                                      <td>总共</br>JUMLAH BAYARAN</td>
                                      <td>RM {{$amount_sum}}</td>
                                    </tr>
                                   
                                  </tbody>
                                </table>

                                <table class="table">
                                  
                                  <tbody>
                                    <tr>
                                      <td>注明</br>Catatan</td>
                                      <td>经手人</br>Penerima</td>
                                    </tr>
                                    
                                  </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


</body>

</html>

<!-- <ul>
    
      <b> No : </b> <li>{{$payment->receipt_no}}</li>
       <b>Tarikh :</b>       <li>{{$payment->payment_date}}</li>
      <b> nama Ketua Keluarga :</b> <li>{{$payment->member->gvBrowseCompanyName}}</li>
       <b>Kawasan :</b> <li>{{$payment->member->area->area_name}}</li>
       <b>No Ahli : </b> <li>
        @foreach($payments as $payment)
        {{$payment->member_id}},
        @endforeach
       </li>
       
       <b>Bayaran Tahunan :</b>
        @foreach($payment->paymentDetails as $paymentDetails) 
                {{$paymentDetails->parentItem->title}}
            @endforeach
       <br>

        <b>Setiap Ahli :</b>  
            <br>
      
    <b>Jumlah Tahun : </b><br>
    <b>Belangan ahli Keluarga</b> <br>
    <b>Jumlah Bayaran :</b> RM 
   
    
</ul> -->
