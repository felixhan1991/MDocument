var TreeView = function () {

    return {
        //main function to initiate the module
        init: function () {

            var DataSourceTree = function (options) {
                this._data  = options.data;
                this._delay = options.delay;
                this._data1 = options.data1;
                this._incre=0;
            };

            DataSourceTree.prototype = {
                
                data: function (options, callback) {
                    var self = this;
                    self._incre++;
                    setTimeout(function () {
                        if (self._incre<2)
                            {
                            var data = $.extend(true, [], self._data);
                            }
                        else var data = $.extend(true, [], self._data1);
                        
                        callback({ data: data });

                    }, this._delay)
                }
            };

            // INITIALIZING TREE
            
            var treeDataSource2 = new DataSourceTree({
                data: [
                    { name: 'Test tree 1 <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Test tree 2 <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-bell-o"></i> Notification', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-bar-chart-o"></i> Assignment', type: 'item', additionalParameters: { id: 'I12' } }
                ],
                delay: 400,
                data1: [
                    { name: 'Coba 1 <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F11' } },
                    { name: 'Test tree 2 <div class="tree-actions"></div>', type: 'folder', additionalParameters: { id: 'F12' } },
                    { name: '<i class="fa fa-bell-o"></i> Notification', type: 'item', additionalParameters: { id: 'I11' } },
                    { name: '<i class="fa fa-bar-chart-o"></i> Assignment', type: 'item', additionalParameters: { id: 'I12' } }
                ],
            });


//            $('#FlatTree').tree({
//                dataSource: treeDataSource,
//                loadingHTML: '<img src="images/input-spinner.gif"/>',
//            });


            $('#FlatTree2').tree({
                dataSource: treeDataSource2,
                loadingHTML: '<img src="images/input-spinner.gif"/>',
            });

//            $('#FlatTree3').tree({
//                dataSource: treeDataSource3,
//                loadingHTML: '<img src="images/input-spinner.gif"/>',
//            });
//
//            $('#FlatTree4').tree({
//                selectable: false,
//                dataSource: treeDataSource4,
//                loadingHTML: '<img src="images/input-spinner.gif"/>',
//            });


        }

    };

}();