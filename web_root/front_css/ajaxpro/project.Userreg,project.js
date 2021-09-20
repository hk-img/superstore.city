if(typeof project == "undefined") project={};
if(typeof project.Userreg == "undefined") project.Userreg={};
project.Userreg_class = function() {};
Object.extend(project.Userreg_class.prototype, Object.extend(new AjaxPro.AjaxClass(), {
	CheckIntro: function(IntroId) {
		return this.invoke("CheckIntro", {"IntroId":IntroId}, this.CheckIntro.getArguments().slice(1));
	},
	CheckMemberId: function(memberID) {
		return this.invoke("CheckMemberId", {"memberID":memberID}, this.CheckMemberId.getArguments().slice(1));
	},
	Getage: function(dob) {
		return this.invoke("Getage", {"dob":dob}, this.Getage.getArguments().slice(1));
	},
	url: '/ajaxpro/project.Userreg,project.ashx'
}));
project.Userreg = new project.Userreg_class();

