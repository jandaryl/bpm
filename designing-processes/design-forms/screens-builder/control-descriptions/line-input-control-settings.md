---
description: >-
  Add a field that displays a text box that the form user can enter plain text
  or a password.
---

# Line Input Control Settings

## Control Description

The Line Input control adds a text box that the form user can enter plain text or a password.

{% hint style="info" %}
This control is not available for [Display](../types-for-screens.md#display)-type ProcessMaker Screens. See [Screen Types](../types-for-screens.md) for more information.
{% endhint %}

## Add the Control to a ProcessMaker Screen

Follow these steps to add this control to the ProcessMaker Screen:

1. View the ProcessMaker Screen page to which to add the control.
2. Go to the **Controls** panel on the left side of the ProcessMaker Screen.
3. Drag the **Line Input** icon ![](../../../../.gitbook/assets/line-input-control-screens-builder-processes.png) from the **Controls** panel to the ProcessMaker Screen page.
4. Drop into the ProcessMaker Screen where you want the control to display on the page.  

   ![](../../../../.gitbook/assets/line-input-screens-builder-processes.png)

Below is a Line Input control in Preview mode.

![Line Input control in Preview mode](../../../../.gitbook/assets/line-input-control-preview-screens-builder-processes.png)

## Inspector Settings

{% hint style="info" %}
For information how to view the **Inspector** panel, see [View the Inspector Panel](../view-the-inspector-pane.md).
{% endhint %}

Below are Inspector settings for the Line Input control:

* **Field Name:** Specify the internal data name of the control that only the Process Owner views at design time. This is a required setting.
* **Field Type:** Select one of the following options:
  * **Text:** The form user enters a single line of plain text into the Line Input control. If the entered text is longer than the field width, the form user's text is clipped.
  * **Password:** The form user enters a password into the Line Input control. Entered text is masked. If the entered text is longer than the field width, the form user's text is clipped.
* **Field Label:** Specify the field label text displayed to the form user.  Set by default as **New Input**.
* **Validation:** Specify the validation rules the form user must comply with to properly enter a valid value into this field.
* **Placeholder:** Specify the placeholder text that displays in the field when no value has been provided.
* **Help Text:** Specify text that provides additional guidance on the field's use.

## Related Topics

{% page-ref page="../types-for-screens.md" %}

{% page-ref page="../view-the-inspector-pane.md" %}

{% page-ref page="./" %}
