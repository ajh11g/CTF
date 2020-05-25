from pwn import *

ticket = "ticket{}\n"

# send ticket
conn = remote('intro2.satellitesabove.me', 5001)
print(conn.recv().decode("utf-8"))

# get numbers
conn.send(ticket)
res = (conn.recv().decode("utf-8"))
print(res)

nums = res.split(" ")
# print(nums[0], nums[2])

# do math
answer = int(nums[0]) + int(nums[2])
#print(answer)

# send answer
conn.send(str(answer) + "\n")
print(conn.recv().decode("utf-8"))

conn.close()
