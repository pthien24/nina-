<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
		<?php include LIBRARIES."sample/mail/layout/header.php"; ?>
		<tr>
			<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="600">
					<tbody>
						<tr style="background:#fff">
							<td align="left" height="auto" style="padding:15px" width="600">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<h1 style="font-size:20px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Kính chào Quý khách</h1>
												<h3 style="font-size:15px;font-weight:bold;color:#000;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd"><span style="font-weight:100;">{emailSubjectSender}</span></h3>
											</td>
										</tr>
										<tr>
											<td>
												<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">{emailContentSender}</p>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<?php include LIBRARIES."sample/mail/layout/footer.php"; ?>
	</tbody>
</table>