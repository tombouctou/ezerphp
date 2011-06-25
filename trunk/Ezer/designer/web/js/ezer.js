
var Ezer = {
	$menu: null,
	$processMenu: null,
	$operatorsMenu: null,
	$phpActionsMenu: null,
	$wsdlActionsMenu: null,
	
	processes: null,
	
	startX: 300,
	startY: 0,
	
	load: function($main){
		
		$main.height($(window).height() - 20);
		$main.css('width', '100%');
//		$main.css('border', '1px solid blue');
		
		this.$menu = $('<div class="menu" id="dvMenu"></div>');
		$main.append(this.$menu);
		this.$menu.height($main.height());
		this.$menu.css('width', this.startX + 'px');
//		this.$menu.css('border', '1px solid red');

		this.loadMenu();
	},
	
	loadMenu: function(){
		
		this.$processMenu = $('<div class="menu-item"></div>');
		this.$menu.append('<h3><a href="#">Process Browser</a></h3>');
		this.$menu.append(this.$processMenu);
		
		this.$operatorsMenu = $('<div class="menu-item"></div>');
		this.$menu.append('<h3><a href="#">Operators</a></h3>');
		this.$menu.append(this.$operatorsMenu);
		
		this.$phpActionsMenu = $('<div class="menu-item"></div>');
		this.$menu.append('<h3><a href="#">PHP Actions</a></h3>');
		this.$menu.append(this.$phpActionsMenu);
		
		this.$wsdlActionsMenu = $('<div class="menu-item"></div>');
		this.$menu.append('<h3><a href="#">WSDL Actions</a></h3>');
		this.$menu.append(this.$wsdlActionsMenu);
				
		this.loadProcessMenu();
		this.$menu.accordion();
	},
	
	loadProcessMenu: function(){
		var scope = this;
		
		$.ajax({
			url: 'ajax/service/process/list',
			dataType: 'json',
			error: function(jqXHR, textStatus, errorThrown){
				alert("Loading process list " + errorThrown);
			},
			success: function(data, textStatus, jqXHR){
				scope.processes = data;
				scope.loadProcesses();
			},
		});
	},
	
	loadProcesses: function(){
		
		this.$processMenu.empty();
		
		var $tree = $('<ul class="filetree"></ul>');
		this.$processMenu.append($tree);
		
		for(var i = 0; i < this.processes.length; i++){
			var process = this.processes[i];
			var $processName = $('<span class="folder">' + process.name + '</span>');
			var $processTree = $('<li id="proc' + process.id + '"></li>');
			$processTree.append($processName);
			$tree.append($processTree);
		}
		
		$tree.treeview();
	}
};