import subprocess
import os

def check_printer_status(printer_ip):
    # Run the ping command to check if the printer is reachable
    try:
        subprocess.run(['ping', '-c', '1', printer_ip], check=True)
        print(f"Printer at {printer_ip} is reachable.")
        return True
    except subprocess.CalledProcessError:
        print(f"Printer at {printer_ip} is not reachable.")
        return False

def print_file(file_path, printer_ip):
    print("Current working directory:", os.getcwd())
    
    # Check if the printer is reachable before attempting to print
    if not check_printer_status(printer_ip):
        return

    if not os.path.exists(file_path):
        print(f"File '{file_path}' not found.")
        return

    # Print directly to the printer using the IP address
    print_command = f"lp -d {printer_ip} {file_path}"
    subprocess.run(print_command, shell=True)

# Example usage
file_path = "log.txt"
printer_ip = "10.153.15.25"  # Replace with the actual IP address of your printer
print_file(file_path, printer_ip)
