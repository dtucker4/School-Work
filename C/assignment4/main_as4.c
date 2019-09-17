#include "as4.h"
#include "B-tree.h"
#include <math.h>
int main(void) {
	int r;
	BTREE* tree = BTree_Create(compareInt);
	for (int i = 0; i < 100; i++) {
		r = rand() % 100;
		BTree_Insert(tree, r);
	}
	BTree_Traverse(tree, process);
	system("pause");
}