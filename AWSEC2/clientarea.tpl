<link rel="stylesheet" href="{$systemurl}modules/servers/AWSEC2/theme/style.css">
<link rel="stylesheet" href="{$systemurl}modules/servers/AWSEC2/theme/flags.css">
    <div class="row m-b-15">
		<div class="col-md-6 col-sm-12">
			<h4>服务信息 <small>Service Detail</small></h4>
		</div>
	</div>
<div id="YVSY">	
	<div class="row">
        <div class="col-md-4 col-sm-12">
            <a href="javascript:;">
                <div class="box">
                    <div class="boxTitle">
                        产品名称
                    </div>
                    <div>
                        <span class="boxContent">{$product}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <a href="javascript:;">
                <div class="box">
                    <div class="boxTitle">
                        产品状态
                    </div>
                    <div>
                        <span class="boxContent">{$status}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-sm-12">
            <a href="javascript:;">
                <div class="box">
                    <div class="boxTitle">
                        到期时间
                    </div>
                    <div>
                        <span class="boxContent">{$nextduedate}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
    <div class="row m-b-15">
		<div class="col-md-12 col-sm-12">
            <h4>产品信息 <small>Product Detail</small> | <a href="?action=productdetails&id={$serviceid}&do=getpem" class="btn btn-default"><i class="fas fa-download"></i> 下载SSH密钥</a></h4>
        </div>
        
    </div>
<div id="YVSY">	
    <div class="row">
    
        <div class="col-md-12 col-sm-12">
            <div class="box">
                <div class="boxTitle">
                    主机名
                </div>
                <div>
                <span class="boxContent">{$domain}</span>
                  </div>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="box">
                <div class="boxTitle">
                    IP地址
                </div>
                <div>
                <span class="boxContent">{$ip}</span>
                  </div>
            </div>
        </div>
        
        
        <div class="col-md-4 col-sm-12">
            <div class="box">
                <div class="boxTitle">
                    操作系统
                </div>
                <div>
                  <span class="boxContent">{$system}</span>
                </div>
             </div>
        </div>
        
        <div class="col-md-4 col-sm-12">
            <div class="box">
                <div class="boxTitle">
                    SSH用户名
                </div>
                <div>
                <span class="boxContent">{$username}</span>
                  </div>
            </div>
        </div>
	</div>
</div>
		