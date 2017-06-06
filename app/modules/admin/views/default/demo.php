
        <div class="row">
        <div class="col-lg-6">
            <table class="layui-box layui-table" lay-even lay-skin="line">
                <colgroup>
                    <col width="40%">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th class="text-center" colspan="2">系统信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Think.Admin 版本</td>
                    <td>{:sysconf('app_version')}</td>
                </tr>
                <tr>
                    <td>ThinkPHP 版本</td>
                    <td>{$Think.const.THINK_VERSION}</td>
                </tr>
                <tr>
                    <td>服务器操作系统</td>
                    <td><?=php_uname('s')?></td>
                </tr>
                <tr>
                    <td>WEB运行环境</td>
                    <td></td>
                </tr>
                <tr>
                    <td>MySQL数据库版本</td>
                    <td>{$mysql_ver}</td>
                </tr>
                <tr>
                    <td>运行PHP版本</td>
                    <td><?=phpversion()?></td>
                </tr>
                <tr>
                    <td>上传大小限制</td>
                    <td><?=ini_get('upload_max_filesize')?></td>
                </tr>
                <tr>
                    <td>POST大小限制</td>
                    <td><?=ini_get('post_max_size')?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="layui-box layui-table" lay-even lay-skin="line">
                <colgroup>
                    <col width="40%">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th class="text-center" colspan="2">产品团队</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>产品名称</td>
                    <td>Think.Admin 管理框架</td>
                </tr>
                <tr>
                    <td>产品研发团队</td>
                    <td>广州楚才信息科技有限公司</td>
                </tr>
                <tr>
                    <td>产品DEMO体验</td>
                    <td>
                        <a target="_blank" href="https://think.ctolog.com">
                            https://think.ctolog.com
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>官方QQ群</td>
                    <td>
                        <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=ae25cf789dafbef62e50a980ffc31242f150bc61a61164458216dd98c411832a">
                            <img src="//pub.idqqimg.com/wpa/images/group.png" style="height:18px;width:auto" alt="PHP微信开发群 (SDK)">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>BUG反馈</td>
                    <td>
                        <a target="_blank" href="https://github.com/zoujingli/Think.Admin/issues">
                            https://github.com/zoujingli/Think.Admin/issues
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>项目地址</td>
                    <td>
                        <a target="_blank" href="https://github.com/zoujingli/Think.Admin">
                            https://github.com/zoujingli/Think.Admin
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>公司官网</td>
                    <td>
                        <a target="_blank" href="http://www.cuci.cc">
                            http://www.cuci.cc
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>公司地址</td>
                    <td>
                        广东省 广州市 海珠区 世港国际公寓E1栋
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
