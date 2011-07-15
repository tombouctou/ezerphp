
var Ezer = {
	$menu: null,
	$canvas: null,
	
	$processMenu: null,
	$processTree: null,
	$operatorsMenu: null,
	$phpActionsMenu: null,
	$wsdlActionsMenu: null,
	
	steps: {},
	
	startX: 300,
	startY: 0,
	
	load: function($main){
		
		$main.css('width', '100%');
//		$main.css('border', '1px solid blue');
		
		var $table = $('<table></table>');
		$main.append($table);
		var $tr = $('<tr></tr>');
		$table.append($tr);
		
		Ezer.$menu = $('<td class="menu" id="tdMenu"></td>');
		$main.append(Ezer.$menu);
		//Ezer.$menu.height($main.height());
		Ezer.$menu.css('width', Ezer.startX + 'px');
//		Ezer.$menu.css('border', '1px solid red');

		Ezer.loadMenu();
		
		Ezer.$canvas = $('<td class="canvas" id="tdCanvas"></td>');
		$main.append(Ezer.$canvas);
		Ezer.$canvas.css('width', ($main.width() - Ezer.startX - 100) + 'px');
		Ezer.$canvas.css('border', '1px solid red');
		
	},
	
	loadMenu: function(){
		
		var height = $(window).height() - 230;

		Ezer.$processMenu = $('<div class="menu-item"></div>');
		Ezer.$processMenu.css('min-height', height + 'px');
		Ezer.$menu.append('<h3><a href="#">Process Browser</a></h3>');
		Ezer.$menu.append(Ezer.$processMenu);
		
		Ezer.$operatorsMenu = $('<div class="menu-item"></div>');
//		Ezer.$operatorsMenu.css('min-height', height + 'px');
		Ezer.$menu.append('<h3><a href="#">Operators</a></h3>');
		Ezer.$menu.append(Ezer.$operatorsMenu);
		
		Ezer.$phpActionsMenu = $('<div class="menu-item"></div>');
//		Ezer.$phpActionsMenu.css('min-height', height + 'px');
		Ezer.$menu.append('<h3><a href="#">PHP Actions</a></h3>');
		Ezer.$menu.append(Ezer.$phpActionsMenu);
		
		Ezer.$wsdlActionsMenu = $('<div class="menu-item"></div>');
//		Ezer.$wsdlActionsMenu.css('min-height', height + 'px');
		Ezer.$menu.append('<h3><a href="#">WSDL Actions</a></h3>');
		Ezer.$menu.append(Ezer.$wsdlActionsMenu);
				
		Ezer.loadProcessMenu();
		Ezer.loadOperatorsMenu();
		Ezer.loadPhpActionsMenu();
		Ezer.loadWsdlActionsMenu();
		Ezer.$menu.accordion({
			fillSpace: true			
		});
	},
	
	loadProcessMenu: function(){
		$.ajax({
			url: 'ajax/index.php/service/process/list',
			dataType: 'json',
			
			error: function(jqXHR, textStatus, errorThrown){
				
				alert("Loading process list " + errorThrown);
			},
			
			success: function(data, textStatus, jqXHR){
				
				for(var i = 0; i < data.length; i++){
					Ezer.steps['step.' + data[i].id] = data[i];
				}
				
				Ezer.loadProcesses();
			},
		});
		
		// TODO - add new process button
	},
	
	loadOperatorsMenu: function(){
		// TODO - list all available operators such as if, else, foreach, etc.
	},
	
	loadPhpActionsMenu: function(){
		// TODO - list all PHP available actions
		// TODO - add new source folder button
	},
	
	loadWsdlActionsMenu: function(){
		// TODO - list all WSDL available actions
		// TODO - add new WSDL URL or file button		
	},
	
	loadProcesses: function(){
		
		Ezer.$processMenu.empty();
		
		Ezer.$processTree = $('<ul class="processes"></ul>');
		Ezer.$processMenu.append(Ezer.$processTree);
		
		var containerIds = new Array();
		for(var i in Ezer.steps){
			Ezer.loadProcess(Ezer.steps[i]);			
			containerIds.push(Ezer.steps[i].id);
		}
		
		Ezer.$processTree.treeview();
		Ezer.loadChildren(containerIds);
	},
	
	loadChildren: function(containerIds){
		$.ajax({
			url: 'ajax/index.php/service/step/list',
			type: 'POST',
			dataType: 'json',
			data: {
				filter: {
					ContainerId: {In: containerIds.join(',')}
				}
			}, 
			error: function(jqXHR, textStatus, errorThrown){
				alert("Loading step list " + errorThrown);
			},
			success: function(data, textStatus, jqXHR){
				
				if(!data.length)
					return;
					
				for(var i = 0; i < data.length; i++){
					Ezer.steps['step.' + data[i].id] = data[i];
				}
				
				Ezer.loadSteps(data);
			},
		});
	},
	
	loadProcess: function(process){
		
		var $processName = Ezer.loadStep(Ezer.$processTree, process);
		
		$processName.click(function(){
			Ezer.paintProcess(process);
		});
	},
	
	loadStep: function($parentNode, step){
		
		var $processName = $('<span class="' + step.objectType + '">' + step.name + '</span>');
		step.$containerItem = $('<li></li>');
		step.$containerItem.append($processName);
		$parentNode.append(step.$containerItem);
		
		return $processName;
	},
	
	loadSteps: function(steps){
		
		var containerIds = new Array();
		for(var i in steps){
			var stepId = steps[i].id;
			var parentId = steps[i].containerId;
			
			var $parentNode = Ezer.steps['step.' + parentId].$containerItem;
			var $processName = Ezer.loadStep($parentNode, Ezer.steps['step.' + stepId]);
			
			$processName.click(function(){
				// TODO focus the step
			});
			
			containerIds.push(stepId);
		}
		
		Ezer.$processTree.treeview();
		Ezer.loadChildren(containerIds);
	},
	
	paintProcess: function(process){
		alert(process.name);
	}
};
