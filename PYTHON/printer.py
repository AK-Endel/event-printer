import cups

def print_text(text):
    # Get the default printer
    conn = cups.Connection()
    printer_name = conn.getDefault()

    # Start a print job
    print_job = conn.createJob(printer_name, "TextPrintJob", {'raw': '1'})

    # Ensure that text is a Unicode string
    if not isinstance(text, str):
        text = str(text)

    # Convert the text to raw data (as bytes)
    raw_data = text.encode('utf-8')

    # Write the raw data to the printer
    conn.writeRequest(print_job, raw_data)

    # Close the print job
    conn.closeJob(print_job)

# Replace 'Hello World' with the text you want to print
print_text('Kood töötab. Email = ??? EventID = ???')
