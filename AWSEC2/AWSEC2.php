<?php

use WHMCS\Database\Capsule;
use Aws\Ec2\Ec2Client;
use Aws\Route53\Route53Client;
use Aws\GlobalAccelerator\GlobalAcceleratorClient;

function AWSEC2_ConfigOptions()
{

    $ec2size = 't1.micro,t2.nano,t2.micro,t2.small,t2.medium,t2.large,t2.xlarge,t2.2xlarge,t3.nano,t3.micro,t3.small,t3.medium,t3.large,t3.xlarge,t3.2xlarge,t3a.nano,t3a.micro,t3a.small,t3a.medium,t3a.large,t3a.xlarge,t3a.2xlarge,t4g.nano,t4g.micro,t4g.small,t4g.medium,t4g.large,t4g.xlarge,t4g.2xlarge,m1.small,m1.medium,m1.large,m1.xlarge,m3.medium,m3.large,m3.xlarge,m3.2xlarge,m4.large,m4.xlarge,m4.2xlarge,m4.4xlarge,m4.10xlarge,m4.16xlarge,m2.xlarge,m2.2xlarge,m2.4xlarge,cr1.8xlarge,r3.large,r3.xlarge,r3.2xlarge,r3.4xlarge,r3.8xlarge,r4.large,r4.xlarge,r4.2xlarge,r4.4xlarge,r4.8xlarge,r4.16xlarge,r5.large,r5.xlarge,r5.2xlarge,r5.4xlarge,r5.8xlarge,r5.12xlarge,r5.16xlarge,r5.24xlarge,r5.metal,r5a.large,r5a.xlarge,r5a.2xlarge,r5a.4xlarge,r5a.8xlarge,r5a.12xlarge,r5a.16xlarge,r5a.24xlarge,r5b.large,r5b.xlarge,r5b.2xlarge,r5b.4xlarge,r5b.8xlarge,r5b.12xlarge,r5b.16xlarge,r5b.24xlarge,r5b.metal,r5d.large,r5d.xlarge,r5d.2xlarge,r5d.4xlarge,r5d.8xlarge,r5d.12xlarge,r5d.16xlarge,r5d.24xlarge,r5d.metal,r5ad.large,r5ad.xlarge,r5ad.2xlarge,r5ad.4xlarge,r5ad.8xlarge,r5ad.12xlarge,r5ad.16xlarge,r5ad.24xlarge,r6g.metal,r6g.medium,r6g.large,r6g.xlarge,r6g.2xlarge,r6g.4xlarge,r6g.8xlarge,r6g.12xlarge,r6g.16xlarge,r6gd.metal,r6gd.medium,r6gd.large,r6gd.xlarge,r6gd.2xlarge,r6gd.4xlarge,r6gd.8xlarge,r6gd.12xlarge,r6gd.16xlarge,x1.16xlarge,x1.32xlarge,x1e.xlarge,x1e.2xlarge,x1e.4xlarge,x1e.8xlarge,x1e.16xlarge,x1e.32xlarge,i2.xlarge,i2.2xlarge,i2.4xlarge,i2.8xlarge,i3.large,i3.xlarge,i3.2xlarge,i3.4xlarge,i3.8xlarge,i3.16xlarge,i3.metal,i3en.large,i3en.xlarge,i3en.2xlarge,i3en.3xlarge,i3en.6xlarge,i3en.12xlarge,i3en.24xlarge,i3en.metal,hi1.4xlarge,hs1.8xlarge,c1.medium,c1.xlarge,c3.large,c3.xlarge,c3.2xlarge,c3.4xlarge,c3.8xlarge,c4.large,c4.xlarge,c4.2xlarge,c4.4xlarge,c4.8xlarge,c5.large,c5.xlarge,c5.2xlarge,c5.4xlarge,c5.9xlarge,c5.12xlarge,c5.18xlarge,c5.24xlarge,c5.metal,c5a.large,c5a.xlarge,c5a.2xlarge,c5a.4xlarge,c5a.8xlarge,c5a.12xlarge,c5a.16xlarge,c5a.24xlarge,c5ad.large,c5ad.xlarge,c5ad.2xlarge,c5ad.4xlarge,c5ad.8xlarge,c5ad.12xlarge,c5ad.16xlarge,c5ad.24xlarge,c5d.large,c5d.xlarge,c5d.2xlarge,c5d.4xlarge,c5d.9xlarge,c5d.12xlarge,c5d.18xlarge,c5d.24xlarge,c5d.metal,c5n.large,c5n.xlarge,c5n.2xlarge,c5n.4xlarge,c5n.9xlarge,c5n.18xlarge,c5n.metal,c6g.metal,c6g.medium,c6g.large,c6g.xlarge,c6g.2xlarge,c6g.4xlarge,c6g.8xlarge,c6g.12xlarge,c6g.16xlarge,c6gd.metal,c6gd.medium,c6gd.large,c6gd.xlarge,c6gd.2xlarge,c6gd.4xlarge,c6gd.8xlarge,c6gd.12xlarge,c6gd.16xlarge,c6gn.medium,c6gn.large,c6gn.xlarge,c6gn.2xlarge,c6gn.4xlarge,c6gn.8xlarge,c6gn.12xlarge,c6gn.16xlarge,cc1.4xlarge,cc2.8xlarge,g2.2xlarge,g2.8xlarge,g3.4xlarge,g3.8xlarge,g3.16xlarge,g3s.xlarge,g4ad.4xlarge,g4ad.8xlarge,g4ad.16xlarge,g4dn.xlarge,g4dn.2xlarge,g4dn.4xlarge,g4dn.8xlarge,g4dn.12xlarge,g4dn.16xlarge,g4dn.metal,cg1.4xlarge,p2.xlarge,p2.8xlarge,p2.16xlarge,p3.2xlarge,p3.8xlarge,p3.16xlarge,p3dn.24xlarge,p4d.24xlarge,d2.xlarge,d2.2xlarge,d2.4xlarge,d2.8xlarge,d3.xlarge,d3.2xlarge,d3.4xlarge,d3.8xlarge,d3en.xlarge,d3en.2xlarge,d3en.4xlarge,d3en.6xlarge,d3en.8xlarge,d3en.12xlarge,f1.2xlarge,f1.4xlarge,f1.16xlarge,m5.large,m5.xlarge,m5.2xlarge,m5.4xlarge,m5.8xlarge,m5.12xlarge,m5.16xlarge,m5.24xlarge,m5.metal,m5a.large,m5a.xlarge,m5a.2xlarge,m5a.4xlarge,m5a.8xlarge,m5a.12xlarge,m5a.16xlarge,m5a.24xlarge,m5d.large,m5d.xlarge,m5d.2xlarge,m5d.4xlarge,m5d.8xlarge,m5d.12xlarge,m5d.16xlarge,m5d.24xlarge,m5d.metal,m5ad.large,m5ad.xlarge,m5ad.2xlarge,m5ad.4xlarge,m5ad.8xlarge,m5ad.12xlarge,m5ad.16xlarge,m5ad.24xlarge,m5zn.large,m5zn.xlarge,m5zn.2xlarge,m5zn.3xlarge,m5zn.6xlarge,m5zn.12xlarge,m5zn.metal,h1.2xlarge,h1.4xlarge,h1.8xlarge,h1.16xlarge,z1d.large,z1d.xlarge,z1d.2xlarge,z1d.3xlarge,z1d.6xlarge,z1d.12xlarge,z1d.metal,u-6tb1.metal,u-9tb1.metal,u-12tb1.metal,u-18tb1.metal,u-24tb1.metal,a1.medium,a1.large,a1.xlarge,a1.2xlarge,a1.4xlarge,a1.metal,m5dn.large,m5dn.xlarge,m5dn.2xlarge,m5dn.4xlarge,m5dn.8xlarge,m5dn.12xlarge,m5dn.16xlarge,m5dn.24xlarge,m5n.large,m5n.xlarge,m5n.2xlarge,m5n.4xlarge,m5n.8xlarge,m5n.12xlarge,m5n.16xlarge,m5n.24xlarge,r5dn.large,r5dn.xlarge,r5dn.2xlarge,r5dn.4xlarge,r5dn.8xlarge,r5dn.12xlarge,r5dn.16xlarge,r5dn.24xlarge,r5n.large,r5n.xlarge,r5n.2xlarge,r5n.4xlarge,r5n.8xlarge,r5n.12xlarge,r5n.16xlarge,r5n.24xlarge,inf1.xlarge,inf1.2xlarge,inf1.6xlarge,inf1.24xlarge,m6g.metal,m6g.medium,m6g.large,m6g.xlarge,m6g.2xlarge,m6g.4xlarge,m6g.8xlarge,m6g.12xlarge,m6g.16xlarge,m6gd.metal,m6gd.medium,m6gd.large,m6gd.xlarge,m6gd.2xlarge,m6gd.4xlarge,m6gd.8xlarge,m6gd.12xlarge,m6gd.16xlarge,mac1.metal';

    $regions = [
        'us-east-1' => '美国东部(弗吉尼亚州)',
        'us-east-2' => '美国东部(俄亥俄州)',
        'us-west-1' => '美国西部(加利福尼亚州)',
        'us-west-2' => '美国西部(俄勒冈州)',
        'af-south-1' => '非洲(开普敦)',
        'ap-east-1' => '亚洲(中国 香港)',
        'ap-south-1' => '亚洲(印度 孟买)',
        'ap-northeast-1' => '亚洲(日本 东京)',
        'ap-northeast-2' => '亚洲(韩国 首尔)',
        'ap-northeast-3' => '亚洲(日本 大阪)',
        'ap-southeast-1' => '亚洲(新加坡)',
        'ap-southeast-2' => '大洋洲(澳大利亚 悉尼)',
        'ca-central-1' => '北美洲(加拿大 中部)',
        'eu-central-1' => '欧洲(德国 法兰克福)',
        'eu-west-1' => '欧洲(爱尔兰)',
        'eu-west-2' => '欧洲(英国 伦敦)',
        'eu-south-1' => '欧洲(意大利 米兰)',
        'eu-west-3' => '欧洲(法国 巴黎)',
        'eu-north-1' => '欧洲(瑞典 斯德哥尔摩)',
        'me-south-1' => '亚洲(巴林)',
        'sa-east-1' => '南美洲(巴西 圣保罗)',
    ];

    $configarray = array(
        'Access Key ID'                => array('Type' => 'text', 'Description' => 'AWS帐号安全设置 <a href="https://console.aws.amazon.com/iam/home#/security_credentials">点此打开</a>'),                //1
        'Secret Access Key'                => array('Type' => 'text'),                //2
        //3
        '实例区域'                    => array('Type' => 'dropdown', 'Options' => $regions, 'Description' => '具体登陆AWS控制台查看'),            //3
        '实例大小'                    => array('Type' => 'dropdown', 'Options' => $ec2size, 'Description' => '具体登陆AWS控制台查看'),  //4
        '操作系统 AMI ID'                 => array('Type' => 'text', 'Description' => '记得先订阅'),  //5
        '全球加速网络(Global Accelerator)' => array('Type' => 'dropdown', 'Options' => array('false' => '关', 'true' => '开')), //6
        '开关机功能' => array('Type' => 'dropdown', 'Options' => array('disable' => '禁用', 'enable' => '启用')), //7
        '自定义前缀'                => array('Type' => 'text'),                //8

    );
    return $configarray;
}

function AWSEC2_CreateAccount(array $params)
{

    try {
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $key = $ec2->createKeyPair([
            'DryRun' => false,
            'KeyName' => $params['configoption8'] . $params['serviceid'], // REQUIRED
        ]);

        AWSEC2_setCustomfieldsValue($params, 'pem', $key['KeyMaterial']);

        $machine = $ec2->runInstances([
            'DisableApiTermination' => false,
            'DryRun' => false,
            'EbsOptimized' => false,
            'ImageId' => $params['configoption5'],
            'InstanceInitiatedShutdownBehavior' => 'stop',
            'InstanceType' => $params['configoption4'],
            'KeyName' => $params['configoption8'] . $params['serviceid'],
            'MaxCount' => 1, // REQUIRED
            'MinCount' => 1, // REQUIRED
            'NetworkInterfaces' => [
                [
                    'AssociateCarrierIpAddress' => false,
                    'AssociatePublicIpAddress' => true,
                    'DeleteOnTermination' => true,
                    'DeviceIndex' => 0,
                    'InterfaceType' => 'interface',
                    'NetworkCardIndex' => 0,
                ],
            ],
            'UserData' => $params['customfields']['cloudinit'],
        ]);
        $data['vm'] = $machine['Instances'][0]['InstanceId'];
        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));

        $nsg = $ec2->createSecurityGroup([
            'Description' =>  $params['configoption8'] . $params['serviceid'], // REQUIRED
            'DryRun' => false,
            'GroupName' => $params['configoption8'] . $params['serviceid'], // REQUIRED
            'VpcId' =>  $machine['Instances'][0]['NetworkInterfaces'][0]['VpcId'],
        ]);

        $data['nsg'] = $nsg['GroupId'];
        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));

        $ec2->modifyNetworkInterfaceAttribute([
            'DryRun' => false,
            'Groups' => [$nsg['GroupId']],
            'NetworkInterfaceId' => $machine['Instances'][0]['NetworkInterfaces'][0]['NetworkInterfaceId'],
        ]);


        $data['nic'] = $machine['Instances'][0]['NetworkInterfaces'][0]['NetworkInterfaceId'];
        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));

        $ec2->authorizeSecurityGroupIngress([
            'DryRun' => false,
            'GroupId' => $nsg['GroupId'],
            'IpPermissions' => [
                [

                    'FromPort' => 1,
                    'ToPort' => 65535,
                    'IpProtocol' => '-1',
                    'IpRanges' => [
                        [
                            'CidrIp' => '0.0.0.0/0',
                            'Description' => 'All ipv4 address. For: ' . $params['configoption8'] . $params['serviceid'],
                        ],
                    ],
                    'Ipv6Ranges' => [
                        [
                            'FromPort' => 1,
                            'ToPort' => 65535,
                            'IpProtocol' => '-1',
                            'CidrIpv6' => '::/0',
                            'Description' => 'All ipv6 address. For: ' . $params['configoption8'] . $params['serviceid'],
                        ],
                    ],
                ],

            ],
        ]);


        $eth = $ec2->describeNetworkInterfaces([
            'DryRun' => false,
            'NetworkInterfaceIds' => [$machine['Instances'][0]['NetworkInterfaces'][0]['NetworkInterfaceId']],
        ]);
        Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['dedicatedip' => $eth['NetworkInterfaces'][0]['Association']['PublicIp']]);

        if ($params['configoption6'] == 'true') {
            $gac = new GlobalAcceleratorClient([
                'region' => 'us-west-2',
                'version' => '2018-08-08',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);

            $ga = $gac->createAccelerator([
                'Enabled' => true,
                'IdempotencyToken' => $params['configoption8'] . $params['serviceid'] . rand(1, time()), // REQUIRED
                'IpAddressType' => 'IPV4',
                'Name' => $params['configoption8'] . $params['serviceid'], // REQUIRED
            ]);


            Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['domain' => $ga['Accelerator']['DnsName']]);

            $data['aga'] = $ga['Accelerator']['AcceleratorArn'];
            AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));

            $tcp = $gac->createListener([
                'AcceleratorArn' => $ga['Accelerator']['AcceleratorArn'], // REQUIRED
                'ClientAffinity' => 'SOURCE_IP',
                'IdempotencyToken' => $params['serviceid'] . rand(1, time()) . $params['configoption8'], // REQUIRED
                'PortRanges' => [ // REQUIRED
                    [
                        'FromPort' => 1,
                        'ToPort' => 65535,
                    ],
                ],
                'Protocol' => 'TCP', // REQUIRED
            ]);

            $udp = $gac->createListener([
                'AcceleratorArn' => $ga['Accelerator']['AcceleratorArn'], // REQUIRED
                'ClientAffinity' => 'SOURCE_IP',
                'IdempotencyToken' => $params['serviceid'] . $params['configoption8'] . rand(1, time()), // REQUIRED
                'PortRanges' => [ // REQUIRED
                    [
                        'FromPort' => 1,
                        'ToPort' => 65535,
                    ],
                ],
                'Protocol' => 'UDP', // REQUIRED
            ]);

            $gac->createEndpointGroup([
                'EndpointConfigurations' => [
                    [
                        'ClientIPPreservationEnabled' => true,
                        'EndpointId' => $machine['Instances'][0]['InstanceId'],
                        'Weight' => 128,
                    ],
                ],
                'EndpointGroupRegion' => $params['configoption3'], // REQUIRED
                'HealthCheckIntervalSeconds' => 30,
                'HealthCheckPort' => 22,
                'HealthCheckProtocol' => 'TCP',
                'IdempotencyToken' => $params['configoption8'] . rand(1, rand(100, 200)) . $params['serviceid'] . rand(1, time()), // REQUIRED
                'ListenerArn' => $tcp['Listener']['ListenerArn'], // REQUIRED
            ]);

            $gac->createEndpointGroup([
                'EndpointConfigurations' => [
                    [
                        'ClientIPPreservationEnabled' => true,
                        'EndpointId' => $machine['Instances'][0]['InstanceId'],
                        'Weight' => 128,
                    ],
                ],
                'EndpointGroupRegion' => $params['configoption3'], // REQUIRED
                'HealthCheckIntervalSeconds' => 30,
                'HealthCheckPort' => 22,
                'HealthCheckProtocol' => 'TCP',
                'IdempotencyToken' => $params['serviceid'] . rand(1, rand(125, 225)) . $params['configoption8'] . rand(1, time()), // REQUIRED
                'ListenerArn' => $udp['Listener']['ListenerArn'], // REQUIRED
            ]);

            $route53 = new Route53Client([
                'region' => 'us-east-1',
                'version' => '2013-04-01',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);

            $check = $route53->createHealthCheck([
                'CallerReference' => $params['configoption8'] . $params['serviceid'] . time(), // REQUIRED
                'HealthCheckConfig' => [ // REQUIRED
                    'Disabled' => false,
                    'IPAddress' => $eth['NetworkInterfaces'][0]['Association']['PublicIp'],
                    'Inverted' => false,
                    'MeasureLatency' => false,
                    'Port' => 22,
                    'Type' => 'TCP', // REQUIRED
                ],
            ]);

            $data['check'] = $check['HealthCheck']['Id'];
            AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        }
        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_SuspendAccount(array $params)
{
    return AWSEC2_shutdown($params);
}


function AWSEC2_UnsuspendAccount(array $params)
{
    return AWSEC2_boot($params);
}

function AWSEC2_TerminateAccount(array $params)
{
    try {
        $data = json_decode($params['customfields']['data'], true);

        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ec2->deleteKeyPair([
            'KeyName' => $params['configoption8'] . $params['serviceid']
        ]);

        $ec2->terminateInstances([
            'DryRun' => false,
            'InstanceIds' => [$data['vm']], // REQUIRED
        ]);
        AWSEC2_disable_aga($params);

        sleep(30);

        $ec2->deleteSecurityGroup([
            'DryRun' => false,
            'GroupId' => $data['nsg'],
        ]);


        AWSEC2_setCustomfieldsValue($params, 'pem', '');
        AWSEC2_setCustomfieldsValue($params, 'data', '');
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}


function AWSEC2_AdminCustomButtonArray()
{
    return array(
        '开机' => 'boot',
        '重启' => 'reboot',
        '关机' => 'shutdown',
        '启用AGA' => 'enable_aga',
        '关闭AGA' => 'disable_aga',
        '删除私钥' => 'delete_pem',
        '删除安全组' => 'delete_nsg',
    );
}

function AWSEC2_ClientAreaCustomButtonArray()
{
    return array(
        '开机' => 'boot',
        '重启' => 'reboot',
        '关机' => 'shutdown',
    );
}


function AWSEC2_ClientArea(array $params)
{
    if ($params['status'] != 'Active') {
        return;
    }

    $data = json_decode($params['customfields']['data'], true);
    if ($_REQUEST['do'] == 'getpem') {
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: " . strlen($params['customfields']['pem']));
        Header("Content-Disposition: attachment; filename=ssh.pem");
        exit($params['customfields']['pem']);
    }

    try {
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $eth = $ec2->describeNetworkInterfaces([
            'DryRun' => false,
            'NetworkInterfaceIds' => [$data['nic']],
        ]);

        Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['dedicatedip' => $eth['NetworkInterfaces'][0]['Association']['PublicIp']]);

        if (isset($data['check'])) {
            $route53 = new Route53Client([
                'region' => 'us-east-1',
                'version' => '2013-04-01',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);

            $route53->updateHealthCheck([
                'HealthCheckId' => $data['check'],
                'Disabled' => false,
                'IPAddress' => $eth['NetworkInterfaces'][0]['Association']['PublicIp'],
                'Inverted' => false,
                'Port' => 22,
            ]);
        }

        return array(
            'tabOverviewReplacementTemplate' => 'clientarea.tpl',
            'vars' => array(
                'ip'    => $eth['NetworkInterfaces'][0]['Association']['PublicIp'],
                'domain' => $params['domain'],
            ),
        );
    } catch (\Exception $e) {
        return "<h1>服务不可用</h1>";
    }
}

function AWSEC2_shutdown(array $params)
{
    if ($params['configoption7'] != 'enable') {
        return '管理员已关闭此功能';
    }

    try {
        $data = json_decode($params['customfields']['data'], true);
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);
        $ec2->stopInstances([
            'DryRun' => false,
            'InstanceIds' => [$data['vm']], // REQUIRED
        ]);
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}


function AWSEC2_boot(array $params)
{
    if ($params['configoption7'] != 'enable') {
        return '管理员已关闭此功能';
    }

    try {
        $data = json_decode($params['customfields']['data'], true);
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ec2->startInstances([
            'DryRun' => false,
            'InstanceIds' => [$data['vm']], // REQUIRED
        ]);
        sleep(5);

        $eth = $ec2->describeNetworkInterfaces([
            'DryRun' => false,
            'NetworkInterfaceIds' => [$data['nic']],
        ]);

        Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['dedicatedip' => $eth['NetworkInterfaces'][0]['Association']['PublicIp']]);

        if (isset($data['check'])) {
            $route53 = new Route53Client([
                'region' => 'us-east-1',
                'version' => '2013-04-01',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);

            $check = $route53->updateHealthCheck([
                'HealthCheckId' => $data['check'],
                'Disabled' => false,
                'IPAddress' => $eth['NetworkInterfaces'][0]['Association']['PublicIp'],
                'Inverted' => false,
                'Port' => 22,
            ]);
        }
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}


function AWSEC2_reboot(array $params)
{
    if ($params['configoption7'] != 'enable') {
        return '管理员已关闭此功能';
    }

    try {
        $data = json_decode($params['customfields']['data'], true);
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ec2->rebootInstances([
            'DryRun' => false,
            'InstanceIds' => [$data['vm']], // REQUIRED
        ]);
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_enable_aga(array $params)
{
    try {
        $data = json_decode($params['customfields']['data'], true);

        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $eth = $ec2->describeNetworkInterfaces([
            'DryRun' => false,
            'NetworkInterfaceIds' => [$data['nic']],
        ]);


        $gac = new GlobalAcceleratorClient([
            'region' => 'us-west-2',
            'version' => '2018-08-08',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ga = $gac->createAccelerator([
            'Enabled' => true,
            'IdempotencyToken' => $params['configoption8'] . $params['serviceid'] . rand(1, time()), // REQUIRED
            'IpAddressType' => 'IPV4',
            'Name' => (string)$params['serviceid'], // REQUIRED
        ]);


        Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['domain' => $ga['Accelerator']['DnsName']]);

        $data['aga'] = $ga['Accelerator']['AcceleratorArn'];

        $tcp = $gac->createListener([
            'AcceleratorArn' => $ga['Accelerator']['AcceleratorArn'], // REQUIRED
            'ClientAffinity' => 'SOURCE_IP',
            'IdempotencyToken' => $params['serviceid'] . rand(1, time()) . $params['configoption8'], // REQUIRED
            'PortRanges' => [ // REQUIRED
                [
                    'FromPort' => 1,
                    'ToPort' => 65535,
                ],
            ],
            'Protocol' => 'TCP', // REQUIRED
        ]);

        $udp = $gac->createListener([
            'AcceleratorArn' => $ga['Accelerator']['AcceleratorArn'], // REQUIRED
            'ClientAffinity' => 'SOURCE_IP',
            'IdempotencyToken' => $params['serviceid'] . $params['configoption8'] . rand(1, time()), // REQUIRED
            'PortRanges' => [ // REQUIRED
                [
                    'FromPort' => 1,
                    'ToPort' => 65535,
                ],
            ],
            'Protocol' => 'UDP', // REQUIRED
        ]);

        $gac->createEndpointGroup([
            'EndpointConfigurations' => [
                [
                    'ClientIPPreservationEnabled' => true,
                    'EndpointId' => $data['vm'],
                    'Weight' => 128,
                ],
            ],
            'EndpointGroupRegion' => $params['configoption3'], // REQUIRED
            'HealthCheckIntervalSeconds' => 30,
            'HealthCheckPort' => 22,
            'HealthCheckProtocol' => 'TCP',
            'IdempotencyToken' => $params['configoption8'] . rand(1, rand(100, 200)) . $params['serviceid'] . rand(1, time()), // REQUIRED
            'ListenerArn' => $tcp['Listener']['ListenerArn'], // REQUIRED
        ]);

        $gac->createEndpointGroup([
            'EndpointConfigurations' => [
                [
                    'ClientIPPreservationEnabled' => true,
                    'EndpointId' => $data['vm'],
                    'Weight' => 128,
                ],
            ],
            'EndpointGroupRegion' => $params['configoption3'], // REQUIRED
            'HealthCheckIntervalSeconds' => 30,
            'HealthCheckPort' => 22,
            'HealthCheckProtocol' => 'TCP',
            'IdempotencyToken' => $params['serviceid'] . rand(1, rand(125, 225)) . $params['configoption8'] . rand(1, time()), // REQUIRED
            'ListenerArn' => $udp['Listener']['ListenerArn'], // REQUIRED
        ]);

        $route53 = new Route53Client([
            'region' => 'us-east-1',
            'version' => '2013-04-01',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $check = $route53->createHealthCheck([
            'CallerReference' => $params['configoption8'] . $params['serviceid'] . time(), // REQUIRED
            'HealthCheckConfig' => [ // REQUIRED
                'Disabled' => false,
                'IPAddress' => $eth['NetworkInterfaces'][0]['Association']['PublicIp'],
                'Inverted' => false,
                'MeasureLatency' => false,
                'Port' => 22,
                'Type' => 'TCP', // REQUIRED
            ],
        ]);

        $data['check'] = $check['HealthCheck']['Id'];
        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_disable_aga(array $params)
{
    try {
        $data = json_decode($params['customfields']['data'], true);

        if (isset($data['check'])) {
            $route53 = new Route53Client([
                'region' => 'us-east-1',
                'version' => '2013-04-01',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);
            $route53->deleteHealthCheck([
                'HealthCheckId' => $data['check'], // REQUIRED
            ]);
            unset($data['check']);
            AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        }

        if (isset($data['aga'])) {
            $gac = new GlobalAcceleratorClient([
                'region' => 'us-west-2',
                'version' => '2018-08-08',
                'credentials' => [
                    'key' => $params['configoption1'],
                    'secret' => $params['configoption2']
                ],
            ]);

            $gac->updateAccelerator([
                'AcceleratorArn' => $data['aga'], // REQUIRED
                'Enabled' => false,
                'IpAddressType' => 'IPV4',
            ]);

            $listeners = $gac->listListeners([
                'AcceleratorArn' => $data['aga']
            ]);

            foreach ($listeners['Listeners'] as $listener) {
                $endgroups = $gac->listEndpointGroups([
                    'ListenerArn' => $listener['ListenerArn'],
                ]);
                foreach ($endgroups['EndpointGroups'] as $endgroup) {
                    $gac->deleteEndpointGroup([
                        'EndpointGroupArn' => $endgroup['EndpointGroupArn'],
                    ]);
                }

                $gac->deleteListener([
                    'ListenerArn' => $listener['ListenerArn'],
                ]);
            }

            sleep(30);

            $gac->deleteAccelerator([
                'AcceleratorArn' => $data['aga'], // REQUIRED
            ]);

            unset($data['aga']);
            Capsule::table('tblhosting')->where('id', $params['serviceid'])->update(['domain' => '']);
            AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        }

        AWSEC2_setCustomfieldsValue($params, 'data', json_encode($data));
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_delete_pem(array $params)
{
    try {
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ec2->deleteKeyPair([
            'KeyName' => $params['serviceid']
        ]);
        AWSEC2_setCustomfieldsValue($params, 'pem', '');
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_delete_nsg(array $params)
{
    try {
        $data = json_decode($params['customfields']['data'], true);
        $ec2 = new Ec2Client([
            'region' => $params['configoption3'],
            'version' => '2016-11-15',
            'credentials' => [
                'key' => $params['configoption1'],
                'secret' => $params['configoption2']
            ],
        ]);

        $ec2->deleteSecurityGroup([
            'DryRun' => false,
            'GroupId' => $data['nsg'],
        ]);


        AWSEC2_setCustomfieldsValue($params, 'pem', '');
        AWSEC2_setCustomfieldsValue($params, 'data', '');
        return 'success';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function AWSEC2_setCustomfieldsValue(array $params, string $field, string $value)
{

    $res = Capsule::table('tblcustomfields')->where('relid', $params['pid'])->where('fieldname', $field)->first();
    if ($res) {
        $fieldValue = Capsule::table('tblcustomfieldsvalues')->where('relid', $params['serviceid'])->where('fieldid', $res->id)->first();
        if ($fieldValue) {
            if ($fieldValue->value !== $value) {
                Capsule::table('tblcustomfieldsvalues')
                    ->where('relid', $params['serviceid'])
                    ->where('fieldid', $res->id)
                    ->update(
                        [
                            'value' => $value,
                        ]
                    );
            }
        } else {
            Capsule::table('tblcustomfieldsvalues')
                ->insert(
                    [
                        'relid'   => $params['serviceid'],
                        'fieldid' => $res->id,
                        'value'   => $value,
                    ]
                );
        }
    }
}
