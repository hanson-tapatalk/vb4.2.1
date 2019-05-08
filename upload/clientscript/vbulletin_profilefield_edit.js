/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.1 Patch Level 1
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2019 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
vBulletin.events.systemInit.subscribe(function(){if(AJAX_Compatible){new vB_ProfilefieldEditor_Factory()}});function vB_ProfilefieldEditor_Factory(){this.controls=new Array();this.open_fieldid=null;this.loading=false;this.init()}vB_ProfilefieldEditor_Factory.prototype.init=function(){this.control_image=new Image();this.control_image.src=IMGDIR_MISC+"/userfield_edit.gif";var A;if(vBulletin.elements.vB_ProfilefieldEditor){for(var B=0;B<vBulletin.elements.vB_ProfilefieldEditor.length;B++){A=vBulletin.elements.vB_ProfilefieldEditor[B];this.controls[A]=new vB_ProfilefieldEditor(A,this)}vBulletin.elements.vB_ProfilefieldEditor=null}this.progress_image=new Image();this.progress_image.src=IMGDIR_MISC+"/11x11progress.gif"};vB_ProfilefieldEditor_Factory.prototype.close_all=function(){if(this.open_fieldid){this.controls[this.open_fieldid].deactivate()}};vB_ProfilefieldEditor_Factory.prototype.set_open_fieldid=function(A){console.log("set_open_fieldid(%s)",String(A));this.open_fieldid=A};function vB_ProfilefieldEditor(A,B){this.element=YAHOO.util.Dom.get("profilefield_value_"+A);this.control_parent=YAHOO.util.Dom.get("profilefield_title_"+A);this.fieldid=A;this.factory=B;this.value=this.element.innerHTML;if(this.control_parent){this.control=this.control_parent.appendChild(document.createElement("a"));this.control.href="#";this.control_image=this.control.appendChild(document.createElement("img"));this.control_image.src=this.factory.control_image.src;this.control_image.border=0;this.control_image.hspace=6;this.control_image.alt=vbphrase.edit_value_js;this.control_image.title=vbphrase.edit_value_js;YAHOO.util.Event.on(this.control,"click",this.activate,this,true)}}vB_ProfilefieldEditor.prototype.unregister=function(){if(this.control){this.control.parentNode.removeChild(this.control)}this.deactivate()};vB_ProfilefieldEditor.prototype.activate=function(A){YAHOO.util.Event.stopEvent(A);if(this.factory.open_fieldid==this.fieldid){console.log("This field (%s) is already open",this.fieldid);return false}else{if(this.factory.loading){console.log("Loading already in progress...");return false}}this.factory.close_all();if(this.control_parent){this.control_image.src=this.factory.progress_image.src}this.value=this.element.innerHTML;this.factory.loading=true;YAHOO.util.Connect.asyncRequest("POST",fetch_ajax_url("ajax.php"),{success:this.show_controls,failure:this.request_timeout,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&do=fetchuserfield&fieldid="+PHP.urlencode(this.fieldid));return false};vB_ProfilefieldEditor.prototype.show_controls=function(C){this.factory.loading=false;var A=C.responseXML.getElementsByTagName("error");if(A[0]){alert(A[0].firstChild.nodeValue);this.deactivate()}else{this.factory.set_open_fieldid(this.fieldid);if(this.control_parent){this.control_image.src=this.factory.control_image.src}this.element.innerHTML=C.responseXML.getElementsByTagName("template")[0].firstChild.nodeValue;this.form=this.element.getElementsByTagName("form")[0];YAHOO.util.Event.on(this.form,"submit",this.save,this,true);YAHOO.util.Event.on(this.form,"reset",this.deactivate,this,true);for(var B=0;B<this.form.elements.length;B++){if(this.form.elements[B].tagName=="INPUT"||this.form.elements[B].tagName=="SELECT"||this.form.elements[B].tagName=="TEXTAREA"){this.form.elements[B].focus();break}}}if(C.responseXML.getElementsByTagName("uneditable")[0]){this.unregister()}};vB_ProfilefieldEditor.prototype.save=function(B){YAHOO.util.Event.stopEvent(B);if(YAHOO.util.Dom.get("field_edit_progress")){YAHOO.util.Dom.removeClass("field_edit_progress","hidden")}else{if(this.control_parent){this.control_image.src=this.factory.progress_image.src}}var A=new vB_Hidden_Form(null);A.add_variables_from_object(this.element);YAHOO.util.Connect.asyncRequest("POST",fetch_ajax_url("ajax.php"),{success:this.post_save,failure:this.request_timeout,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&do=saveuserfield&fieldid="+this.fieldid+"&"+A.build_query_string())};vB_ProfilefieldEditor.prototype.post_save=function(B){var A=B.responseXML.getElementsByTagName("error");if(A[0]){this.reset_progress();if(YAHOO.util.Dom.get("field_edit_error_container")){YAHOO.util.Dom.removeClass("field_edit_error_container","hidden");YAHOO.util.Dom.get("field_edit_errors").innerHTML=A[0].firstChild.nodeValue}}else{this.value=B.responseXML.getElementsByTagName("value")[0].firstChild.nodeValue;this.deactivate()}if(B.responseXML.getElementsByTagName("uneditable")[0]){this.unregister()}};vB_ProfilefieldEditor.prototype.reset_progress=function(){if(this.control_image){this.control_image.src=this.factory.control_image.src}if(YAHOO.util.Dom.get("field_edit_progress")){YAHOO.util.Dom.addClass("field_edit_progress","hidden")}};vB_ProfilefieldEditor.prototype.deactivate=function(){this.reset_progress();this.element.innerHTML=this.value;this.factory.set_open_fieldid(null)};vB_ProfilefieldEditor.prototype.request_timeout=function(A){vBulletin_AJAX_Error_Handler(A);alert(vbphrase.server_failed_respond_try_again);this.deactivate()};