
if(!Ezer)
	var Ezer = {};
Ezer.draw2d = {};

Ezer.draw2d.View = function(id){
	draw2d.Workflow.call(this,id);
};
Ezer.draw2d.View.prototype = new draw2d.Workflow();
Ezer.draw2d.View.prototype.type = "Ezer.draw2d.View";
Ezer.draw2d.View.prototype.addFigure = function(figure, xPos, yPos){
	xPos += this.getAbsoluteX();
	yPos += this.getAbsoluteY();
	draw2d.Workflow.prototype.addFigure.call(this, figure, xPos, yPos, true);
};

Ezer.draw2d.Process = function(workflow, process){
	if(!workflow)
		return;
		
	this.workflow = workflow;
	this.workflow.clear();
	var header = new draw2d.Label(process.name);
	this.workflow.addFigure(header, 10, 10);
	
	for(var i = 0; i < process.children.length; i++){
		var stepIndex = process.children[i];
		this.loadStep(Ezer.getStep(stepIndex));
	}
};
Ezer.draw2d.Process.prototype.type = "Ezer.draw2d.Process";
Ezer.draw2d.Process.prototype.loadStep = function(step){
	if(!Ezer.draw2d[step.objectType]){
		alert("Object draw type [" + step.objectType + "] could not be found");
		return;
	}
	var stepClass = Ezer.draw2d[step.objectType];
	return new stepClass(this, step);
};
Ezer.draw2d.Process.prototype.addStepFigure = function(step2d){
	this.workflow.addFigure(step2d, 10, 30);
};

Ezer.draw2d.Step = function(process2d, step){
	draw2d.Node.call(this);
	if(!process2d)
		return;
		
	process2d.addStepFigure(this);
	this.headerLabel.innerHTML = step.name;
	this.recalculateSize();
	this.parentContainer = null;
};
Ezer.draw2d.Step.prototype = new draw2d.Node();
Ezer.draw2d.Step.prototype.type = "Ezer.draw2d.Step";
Ezer.draw2d.Step.prototype.setParentContainer = function(container){
	this.parentContainer = container;
};
Ezer.draw2d.Step.prototype.recalculateSize = function(name){
	this.setDimension(this.getWidth(),this.getHeight());
	this.paint();
};
Ezer.draw2d.Step.prototype.createHTMLElement = function(){
	var item = document.createElement("div");
	item.id = this.id;
	item.style.position = "absolute";
	item.style.left = this.x+"px";
	item.style.top = this.y+"px";
	item.style.height = this.width+"px";
	item.style.width = this.height+"px";
//	item.style.width = "auto";
//	item.style.height = "auto";
	item.style.margin = "0px";
	item.style.padding = "0px";
	item.style.outline = "none";
	item.style.border = "1px solid black";
	item.style.zIndex = ""+draw2d.Figure.ZOrderBaseIndex;
	item.style.backgroundColor = "rgb(255,255,206)";
	//this.disableTextSelection(item);
	this.table = document.createElement("table");
	this.table.style.width = "100%";
	this.table.style.height = "100%";
	this.table.style.margin = "0px";
	this.table.style.padding = "0px";
	item.appendChild(this.table);
	this.tbody = document.createElement("tbody");
	this.table.appendChild(this.tbody);
	var tr = document.createElement("tr");
	tr.style.backgroundColor = "transparent";
	this.tbody.appendChild(tr);
	this.headerLabel = document.createElement("td");
	this.headerLabel.style.align = "left";
	this.headerLabel.style.verticalAlign = "top";
	this.headerLabel.style.borderBottom = "1px solid black";
	this.headerLabel.style.fontWeight = "bold";
	this.headerLabel.style.textAlign = "center";
	tr.appendChild(this.headerLabel);
	this.headerLabel.innerHTML = "";
	return item;
};
Ezer.draw2d.Step.prototype.getWidth = function(){
	if(this.workflow === null){
			return 10;
	}
	if(this.table.xgetBoundingClientRect){
		return this.table.getBoundingClientRect().right-this.table.getBoundingClientRect().left;
	}else{
		if(document.getBoxObjectFor){
			return document.getBoxObjectFor(this.table).width;
		}else{
			return this.table.offsetWidth;
		}
	}
};
Ezer.draw2d.Step.prototype.getHeight = function(){
	if(this.workflow === null){
		return 10;
	}
	if(this.table.xgetBoundingClientRect){
		return this.table.getBoundingClientRect().bottom-this.table.getBoundingClientRect().top;
	}else{
		if(document.getBoxObjectFor){
			return document.getBoxObjectFor(this.table).height;
		}else{
			return this.table.offsetHeight;
		}
	}
};



Ezer.draw2d.ActivityStep = function(process2d, step){
	Ezer.draw2d.Step.call(this, process2d, step);
	if(!process2d)
		return;
		
	this.classLabel.innerHTML = step.className;
	this.setArgs(step.args);
	
	this.recalculateSize();
};
Ezer.draw2d.ActivityStep.prototype = new Ezer.draw2d.Step();
Ezer.draw2d.ActivityStep.prototype.type = "Ezer.draw2d.StepContainer";
Ezer.draw2d.ActivityStep.prototype.createHTMLElement = function(){
	
	var item = Ezer.draw2d.Step.prototype.createHTMLElement.call(this);
	
	var tr = document.createElement("tr");
	tr.style.backgroundColor = "transparent";
	this.tbody.appendChild(tr);
	this.classLabel = document.createElement("td");
	this.classLabel.style.align = "left";
	this.classLabel.style.verticalAlign = "top";
	this.classLabel.style.borderBottom = "1px solid black";
	this.classLabel.style.fontWeight = "bold";
	this.classLabel.style.textAlign = "center";
	this.classLabel.style.color = "blue";
	tr.appendChild(this.classLabel);
	this.classLabel.innerHTML = "";
	
	return item;
};
Ezer.draw2d.ActivityStep.prototype.setArgs = function(args){
	
	for(var i = 0; i < args.length; i++){
		var tr = document.createElement("tr");
		tr.style.backgroundColor = "transparent";
		this.tbody.appendChild(tr);
		var argLabel = document.createElement("td");
		argLabel.style.align = "left";
		argLabel.style.verticalAlign = "top";
		argLabel.style.borderBottom = "0px";
		argLabel.style.fontWeight = "normal";
		argLabel.style.textAlign = "left";
		argLabel.style.color = "blue";
		argLabel.innerHTML = "+ " + args[i];
		tr.appendChild(argLabel);
	}
};


Ezer.draw2d.StepContainer = function(process2d, step){
	Ezer.draw2d.Step.call(this, process2d, step);
	if(!process2d)
		return;
		
	this.children = new Array();
	for(var i = 0; i < step.children.length; i++){
		var stepIndex = step.children[i];
		var childStep = process2d.loadStep(Ezer.getStep(stepIndex));
		this.children.push(childStep);
		childStep.setParentContainer(this);
	}
	
	this.recalculateSize();
};
Ezer.draw2d.StepContainer.prototype = new Ezer.draw2d.Step();
Ezer.draw2d.StepContainer.prototype.type = "Ezer.draw2d.StepContainer";



Ezer.draw2d.Sequence = function(process2d, sequence){
	Ezer.draw2d.StepContainer.call(this, process2d, sequence);
};
Ezer.draw2d.Sequence.prototype = new Ezer.draw2d.StepContainer();
Ezer.draw2d.Sequence.prototype.type = "Ezer.draw2d.Sequence";



Ezer.draw2d.Foreach = function(process2d, sequence){
	Ezer.draw2d.StepContainer.call(this, process2d, sequence);
};
Ezer.draw2d.Foreach.prototype = new Ezer.draw2d.StepContainer();
Ezer.draw2d.Foreach.prototype.type = "Ezer.draw2d.Foreach";

