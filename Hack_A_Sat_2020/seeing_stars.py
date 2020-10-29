from termcolor import colored
from pwn import *

ticket = "ticket{charlie45435foxtrot:GNAV4dgEF3_gypL2fUwNiKDZw5TKm2SneBVZtqZNvoGvo66k6e6r_emu9mS6Gv-KtQ}\n"

# connect
conn = remote('stars.satellitesabove.me', 5013)
print(colored("[+] " + conn.recv().decode("utf-8"), "green"))

# send ticket
print(colored("[-] Sending ticket...", "yellow"))
conn.send(ticket)
print(colored("[-] Receiving...", "yellow"))
res1 = conn.recv().decode("utf-8")
print(res1)

# count total number of digits
#digitscount = sum(i.isdigit() for i in res1)
#print(digitscount)

# format string to list
res2 = res1.rstrip('\n')
list = res2.split(",")

# combine list items into coordinates
list2 = [','.join(i) for i in zip(list[0::2], list[1::2])]
print(list2)

conn.close()
