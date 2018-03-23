Zorgmail SOAP client
====================

Simple Client library for Zorgmail SOAP service. It just handles the transport,
no message parsing/generation is being performed by this library.

## Testing and development

Copy the `.env.dist` file to `.env` and adjust to your liking.

You can now run the examples from the `example/` directory.

## Notes

* This library is using a cached version of the WSDL as the [original](https://lms.lifeline.nl/mailwebservice/inline/ems-mailwebservice-inline.wsdl) requires basic auth to read.
* In order to send XML formatted EDI messages such as MEDVRI, MEDLAB, etc, you
need to use `edifactverwerking@lms.lifeline.nl` as the recipient, and address
the final recipient in the XML message (envelope).
* Sending `text/plain` message to a (test) box will result in it being sent to a Secure Email box instead.
* Sending `text/xml` (even if it's just <hello />) will deliver the message in the edi box as planned.
* Sending to self (test accounts) works.
* During send, messageIds need to be in format `<1234@example.web>`, or an exception will be thrown.
* The SOAP client won't want for a response on one-way calls (like `Send`) unless `SOAP_WAIT_ONE_WAY_CALLS` features flag is set during client instantiation. This way you'll receive status codes or exceptions on invalid input.

## License

MIT. Please refer to the [license file](LICENSE) for details.

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!

